<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrustedSpecialistRequest;
use App\Http\Requests\UpdateTrustedSpecialistRequest;
use App\Models\TrustedSpecialist;
use Illuminate\Http\Request;

class TrustedSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trustedSpecialists = TrustedSpecialist::all();
        return view('trusted-specialists.index', compact('trustedSpecialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trusted-specialists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrustedSpecialistRequest $request)
    {
        $trustedSpecialist = TrustedSpecialist::create($request->validated());
        return redirect()->route('trusted-specialists.show', $trustedSpecialist)->with('success', 'Trusted Specialist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrustedSpecialist $trustedSpecialist)
    {
        return view('trusted-specialists.show', compact('trustedSpecialist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrustedSpecialist $trustedSpecialist)
    {
        return view('trusted-specialists.edit', compact('trustedSpecialist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrustedSpecialistRequest $request, TrustedSpecialist $trustedSpecialist)
    {
        $trustedSpecialist->update($request->validated());
        return redirect()->route('trusted-specialists.show', $trustedSpecialist)->with('success', 'Trusted Specialist updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrustedSpecialist $trustedSpecialist)
    {
        $trustedSpecialist->delete();
        return redirect()->route('trusted-specialists.index')->with('success', 'Trusted Specialist deleted successfully.');
    }
}
