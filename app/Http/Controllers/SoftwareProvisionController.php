<?php

namespace App\Http\Controllers;

use App\Models\ATSoftware;
use App\Models\Client;
use App\Models\SoftwareProvision;
use Illuminate\Http\Request;

class SoftwareProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwareProvisions = SoftwareProvision::with(['client', 'software'])
                                              ->latest()
                                              ->paginate(10);
        
        return view('software-provisions.index', compact('softwareProvisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $software = ATSoftware::all();
        
        return view('software-provisions.create', compact('clients', 'software'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'at_software_id' => 'required|exists:a_t_software,id',
            'provision_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $softwareProvision = SoftwareProvision::create($validated);
        
        return redirect()->route('software-provisions.show', $softwareProvision)
            ->with('success', 'Software provision created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SoftwareProvision $softwareProvision)
    {
        return view('software-provisions.show', compact('softwareProvision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoftwareProvision $softwareProvision)
    {
        $clients = Client::all();
        $software = ATSoftware::all();
        
        return view('software-provisions.edit', compact('softwareProvision', 'clients', 'software'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoftwareProvision $softwareProvision)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'at_software_id' => 'required|exists:a_t_software,id',
            'provision_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $softwareProvision->update($validated);
        
        return redirect()->route('software-provisions.show', $softwareProvision)
            ->with('success', 'Software provision updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoftwareProvision $softwareProvision)
    {
        $softwareProvision->delete();
        
        return redirect()->route('software-provisions.index')
            ->with('success', 'Software provision deleted successfully.');
    }
}
