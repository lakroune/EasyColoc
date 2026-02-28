<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Models\ColocationUser;
use App\Models\Dette;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colocations = Colocation::with(['colocationUsers.user'])
            ->whereHas('colocationUsers', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->get();
        return  view('colocation.index', compact('colocations'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {

        $data = $request->validated();
        $data['status'] = true;
        $data['owner_id'] = auth()->user()->id;
        if (ColocationUser::where('user_id', auth()->user()->id)->where("is_leave", false)->exists())
            return back()->with('error', 'Vous avez déja une colocation en cours');
        DB::transaction(function () use ($data) {
            $colocation = Colocation::create($data);
            ColocationUser::create([
                'user_id' => auth()->user()->id,
                'colocation_id' => $colocation->id,
                'is_owner' => true,
                'is_leave' => false
            ]);
        });
        return back()->with('success', 'vous avez cree une colocation');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        if ($colocation->colocationUsers()->where('user_id', auth()->user()->id)->where('is_leave', false)->doesntExist())
            return redirect()->route('dashboard')->with('error', 'vous n\'etes pas membre de cette colocation');
        $membres = $colocation->colocationUsers()->where('is_leave', false)->with('user')->get();
        $all_membres = $colocation->colocationUsers()->with('user')->get();
        $categories = $colocation->categories()->get();
        $depenses = collect();

        foreach ($all_membres as $membre) {
            $depensesmembre = $membre->depenses()->with(['categorie'])->latest()->get();
            $depenses = $depenses->merge($depensesmembre);
        }

        $membresIds = [];
        foreach ($all_membres as $membre) {
            $membresIds[] = $membre->id;
        }

        $dettes = Dette::whereIn('colocation_user_id', $membresIds)
            ->with(['colocationUser.user', 'depense.colocationUser.user'])
            ->latest()
            ->get();
        $depenses = $depenses->sortByDesc('created_at');
        return   view('colocation.show', compact('colocation', 'membres', 'categories', 'depenses', 'dettes'));
    }
 


    /**
     * Quitter une colocation.
     * 
     */
    public function leave(Colocation $colocation)
    {
        DB::transaction(function () use ($colocation) {

            $membre = ColocationUser::where('colocation_id', $colocation->id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $membre->update(['is_leave' => true]);

            $user = $membre->user;


            $ownerColocUser = $colocation->colocationUsers()->where('is_owner', true)->first();

            if (!$ownerColocUser) {
                return back()->with('error', 'error');
            }

            $owner = $ownerColocUser->user;

            $dettes_non_payees = Dette::where('colocation_user_id', $membre->id)
                ->get();

            // return  $dettes_non_payees;
            $totalDette = 0;

            foreach ($dettes_non_payees as $dette) {
                $dette->update(['colocation_user_id' => $ownerColocUser->id]);
                $totalDette += $dette->montant;
            }

            if ($user->solde < 0 || $totalDette > 0) {
                $owner->solde -= $totalDette;
                $owner->save();

                $user->decrement('reputation');
            } else {
                $user->increment('reputation');
            }
            $user->solde = 0;
            $user->save();
        });

        return redirect()->route('colocations.index')->with('success', 'Vous avez quitté la colocation.');
    }

    public function destroy(Colocation $colocation)
    {
        if ($colocation->owner_id !== auth()->id()) {
            abort(403);
        }
        $colocation->update(['status' => false]);
        foreach ($colocation->colocationUsers as $membre) {
            $membre->update(['is_leave' => true]);
            $user = $membre->user;
            $user->solde = 0;
            $user->save();
        }

        return redirect()->route('colocations.index')->with('success', 'vous avez annulé la colocation.');
    }

    /**
     * Expulse un membre de la colocation
     *
     * @param Colocation $colocation
     * @param ColocationUser $membre
     * @return void
     */
    public function kickMember(Colocation $colocation, ColocationUser $membre)
    {
        $ownerColocUser = $colocation->colocationUsers()->where('is_owner', true)->first();

        if (!$ownerColocUser || auth()->id() !== $ownerColocUser->user_id) {
            abort(403, 'Seul l\'owner peut expulser un membre.');
        }

        if ($membre->user_id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous expulser vous-même.');
        }

        DB::transaction(function () use ($colocation, $membre, $ownerColocUser) {
            $membre->update(['is_leave' => true]);

            $user = $membre->user;
            $owner = $ownerColocUser->user;

            $dettes_non_payees = Dette::where('colocation_user_id', $membre->id)
                ->where('statut', false)
                ->get();

            $totalDette = 0;
            foreach ($dettes_non_payees as $dette) {
                $dette->update(['colocation_user_id' => $ownerColocUser->id]);
                $totalDette += $dette->montant;
            }

            if ($user->solde < 0 || $totalDette > 0) {
                $owner->solde -= $totalDette;
                $owner->save();
                $user->decrement('reputation');
            } else {
                $user->increment('reputation');
            }

            $user->solde = 0;
            $user->save();
        });

        return back()->with('success', 'Membre expulsé avec success.');
    }

    /**
     * Transfert le rôle d'owner
     * 
     * 
     */

    public function changeOwner(Colocation $colocation, ColocationUser $newOwner)
    {
        // return  $newOwner;
        $ownerColocUser = $colocation->colocationUsers()->where('is_owner', true)->first();

        if (!$ownerColocUser || auth()->id() !== $ownerColocUser->user_id) {
            abort(403, 'Seul l\'owner peut expulser un membre.');
        }

        DB::transaction(function () use ($colocation, $newOwner) {
            ColocationUser::where('colocation_id', $colocation->id)
                ->update(['is_owner' => false]);

            ColocationUser::where('id', $newOwner->id)
                ->update(['is_owner' => true]);
        });

        return back()->with('success', 'Le rôle d\'owner a été transféré.');
    }
}
