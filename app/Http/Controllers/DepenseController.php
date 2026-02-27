<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;
use App\Models\ColocationUser;
use Illuminate\Support\Facades\DB;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('expense.index');
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
    public function store(StoreDepenseRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $colocationUser = ColocationUser::where('user_id', auth()->id())
                ->where('colocation_id', $request->colocation_id)
                ->firstOrFail();

            $data['colocation_user_id'] = $colocationUser->id;
            $depense = Depense::create($data);

            $membres = ColocationUser::where('is_leave', false)->where('colocation_id', $depense->colocationUser->colocation_id)->get();
            foreach ($membres as $membre) {
                if ($membre->user_id === auth()->user()->id) {
                    $membre->user->solde +=  $data['montant'] - ($data['montant'] / (count($membres)));
                } else {
                    $membre->user->solde -=   ($data['montant'] / (count($membres)));
                }
                $membre->user->save();
            }
        });
        return   back()->with('success', 'Depense ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        //
    }
}
