<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use App\Models\ColocationUser;
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
        $data['token'] = Str::random(10);
        $data['owner_id'] = auth()->user()->id;
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
        ColocationUser::where('colocation_id', $colocation->id)
            ->where('user_id', auth()->id())
            ->update(['is_leave' => true]);
        return redirect()->route('colocations.index')->with('success', 'Vous avez quitté la colocation.');
    }

    public function destroy(Colocation $colocation)
    {
        if ($colocation->owner_id !== auth()->id()) {
            abort(403);
        }
        $colocation->update(['status' => false]);
        return redirect()->route('colocations.index')->with('success', 'vous avez annulé la colocation.');
    }
}
