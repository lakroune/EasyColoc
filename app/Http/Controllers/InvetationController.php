<?php

namespace App\Http\Controllers;

use App\Models\Invetation;
use App\Http\Requests\StoreInvetationRequest;
use App\Http\Requests\UpdateInvetationRequest;
use App\Mail\InvitationMail;
use App\Models\Colocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        DB::transaction(function () use ($data) {
            $colocation = Colocation::find($data['colocation_id']);
            Mail::to($data['email'])->send(new InvitationMail($colocation));
            Invetation::create($data);
        });
        return back()->with('success', 'Invitation envoyée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invetation $invetation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invetation $invetation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvetationRequest $request, Invetation $invetation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invetation $invetation)
    {
        //
    }
}
