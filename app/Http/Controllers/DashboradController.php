<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Invetation;
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

    public function stats()
    {
        $data = [
            'total_users' => User::count(),
            'active_users' => User::where('is_banned', false)->count(),
            'banned_users' => User::where('is_banned', true)->count(),

            'total_colocations' => Colocation::count(),
            'active_colocations' => Colocation::where('status', true)->count(),
            'cancelled_colocations' => Colocation::where('status', false)->count(),

            'total_money' => Depense::sum('montant') ?? 0,
            'avg_expense' => Depense::avg('montant') ?? 0,
            'expenses_count' => Depense::count(),

            'active_invitations' => Invetation::where('status', true)->count(),
            'total_invitations' => Invetation::count(),

            'recent_users' => User::latest()->take(5)->get(['id', 'nom', 'prenom', 'created_at']),
            'recent_expenses' => Depense::with(['colocationUser.user', 'categorie'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.stats', compact('data'));
    }
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
        // return $user;
        if (auth()->id() === $user->id || $user->isAdmin()) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir vous-même.');
        }

        if (!auth()->user()->isAdmin())
            return  back()->with('error', 'Vous ne pouvez pas bannir un administrateur.');
        $user->is_banned = !$user->is_banned;
        if ($user->is_banned) {
            $user->colocationUsers()->update(['is_leave' => true]);
            // 
        }
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
