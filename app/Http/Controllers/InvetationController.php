<?php

namespace App\Http\Controllers;

use App\Models\Invetation;
use App\Http\Requests\StoreInvetationRequest;
use App\Http\Requests\UpdateInvetationRequest;
use App\Mail\InvitationMail;
use App\Models\Colocation;
use App\Models\ColocationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class InvetationController extends Controller
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
    public function store(StoreInvetationRequest $request)
    {
        $data = $request->validated();
        $data['token'] = Str::random(10);
        $invetation = Invetation::create($data);
        Mail::to($data['email'])->send(new InvitationMail($invetation));
        return back()->with('success', $invetation->token);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invetation $invetation)
    {
        if (! auth()->check()) {
            return view('auth.register');
        }
        $colocation = $invetation->colocation;
        return view('invitations.accept', compact('invetation', 'colocation'));
    }

    /**
     * accepter une invitation
     */
    public function accepter($token)
    {
        $invitation = Invetation::where('token', $token)->firstOrFail();
        if (!auth()->check()) {
            return redirect()->route('register')->with('error', 'Vous devez vous connecter.');
        }

        if (auth()->user()->email !== $invitation->email) {
            abort(403, 'Cette invitation ne vous est pas destinée.');
        }
        $dans_coloc = auth()->user()->colocationUsers()
            ->where('is_leave', false) // dans la colocation
            ->whereHas('colocation', function ($query) {
                $query->where('status', true); // colocation active
            })
            ->exists();
        if ($dans_coloc) {
            return redirect()->route('colocations.index')
                ->with('error', 'Vous avez déjà une colocation active. Vous devez la quitter avant d\'en rejoindre une nouvelle.');
        }

        DB::transaction(function () use ($invitation) {
            ColocationUser::updateOrCreate([
                'colocation_id' => $invitation->colocation_id,
                'user_id' => auth()->id(),
            ], [
                'is_owner' => false,
                'is_leave' => false,
            ]);
            $invitation->delete();
        });

        return redirect()->route('colocations.show', $invitation->colocation_id)
            ->with('success', 'Bienvenue dans votre nouvelle colocation');
    }

    public function join(Request $request)
    {

        $data =  $request->validate([
            'token' => 'required|string|exists:invetations,token',
        ], [
            'token.exists' => 'Ce token n\'existe pas',
        ]);

        $this->accepter($data['token']);
        return back()->with('success', 'vous avez rejoint la colocation');
    }
}
