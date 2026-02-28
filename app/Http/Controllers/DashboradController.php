<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
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
     * stats
     */
    public function user()
    {
        if (!auth()->user()->isAdmin())
            return  back()->with('error', 'Vous ne pouvez pas voir les utilisateurs.');
        $users = User::withCount('colocationUsers')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Toggle the status of a user.
     */
    public function toggleStatus(User $user)
    {
        if (auth()->id() === $user->id || $user->isBanned() || $user->isAdmin()) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir vous-même.');
        }
        if (!auth()->user()->isAdmin())
            return  back()->with('error', 'Vous ne pouvez pas bannir un administrateur.');
        $user->is_banned = !$user->is_banned;
        $user->save();

        $message = $user->isBanned() ? 'activé' : 'banni';
        return back()->with('success', "L'utilisateur a été $message avec succès.");
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
