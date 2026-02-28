<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use App\Models\ColocationUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return back()->with('success', 'Colocation ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        $membres = $colocation->colocationUsers()->where('is_leave', false)->with('user')->get();
        $categories = $colocation->categories()->get();
        $depenses = collect();
        foreach ($membres as $membre) {
            $depensesmembre = $membre->depenses()->with(['categorie'])->latest()->get();
            $depenses = $depenses->merge($depensesmembre);
        }
        $depenses = $depenses->sortByDesc('created_at');
        return   view('colocation.show', compact('colocation', 'membres', 'categories', 'depenses'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        //
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
            $owner = User::findOrFail($colocation->owner_id);
            if ($user->solde < 0) {
                $owner->solde += $user->solde;
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
}
