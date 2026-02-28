<?php

namespace App\Http\Controllers;

use App\Models\Dette;
use Illuminate\Http\Request;

class DetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dette $dette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dette $dette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dette $dette)
    {
        if (!$dette->colocationUser || $dette->colocationUser->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à marquer cette dette comme payée.');
        }

        $dette->statut = true;
        $dette->date_paiement = now();
        $dette->save();


        $debteur = $dette->colocationUser->user;
        $debteur->solde += $dette->montant;
        $debteur->save();

        $crediteur = $dette->depense->colocationUser->user;
        $crediteur->solde -= $dette->montant;
        $crediteur->save();

        return redirect()->back()->with('success', 'Dette marquée comme payée ');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dette $dette)
    {
        //
    }
}
