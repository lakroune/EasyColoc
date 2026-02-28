<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class DashboradController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(['colocationUsers.depenses' => function ($query) {
            $query->latest(); // trier par date décroissante
        }, 'colocationUsers.colocation'], 'colocationUsers.depenses.categorie')->find(auth()->id());

        $total_depenses = $user->colocationUsers->sum(function ($membre) {
            return $membre->depenses->sum('montant');
        });
        return view("dashboard", compact("user", "total_depenses"));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
