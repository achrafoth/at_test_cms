<?php

namespace App\Http\Controllers;

use App\Models\Provision;
use App\Models\Client;
use App\Models\ATEquipment;
use App\Http\Requests\StoreProvisionRequest;
use App\Http\Requests\UpdateProvisionRequest;

class ProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provisions = Provision::with(['client', 'equipment'])->latest()->paginate(10);
        return view('provisions.index', compact('provisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        return view('provisions.create', compact('clients', 'equipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvisionRequest $request)
    {
        $validated = $request->validated();
        
        $provision = Provision::create($validated);
        
        return redirect()->route('provisions.show', $provision)
            ->with('success', 'Equipment provisioned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provision $provision)
    {
        $provision->load(['client', 'equipment']);
        return view('provisions.show', compact('provision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provision $provision)
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        return view('provisions.edit', compact('provision', 'clients', 'equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvisionRequest $request, Provision $provision)
    {
        $validated = $request->validated();
        
        $provision->update($validated);
        
        return redirect()->route('provisions.show', $provision)
            ->with('success', 'Provision updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provision $provision)
    {
        $provision->delete();
        
        return redirect()->route('provisions.index')
            ->with('success', 'Provision deleted successfully.');
    }
}
