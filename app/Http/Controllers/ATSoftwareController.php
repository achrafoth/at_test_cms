<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreATSoftwareRequest;
use App\Http\Requests\UpdateATSoftwareRequest;
use App\Models\ATSoftware;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ATSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $software = ATSoftware::with('supplier')->latest()->paginate(10);
        
        return view('at-software.index', compact('software'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        
        return view('at-software.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreATSoftwareRequest $request)
    {
        $software = ATSoftware::create($request->validated());
        
        return redirect()->route('at-software.show', $software)
            ->with('success', 'Software created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ATSoftware $atSoftware)
    {
        return view('at-software.show', compact('atSoftware'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ATSoftware $atSoftware)
    {
        $suppliers = Supplier::all();
        
        return view('at-software.edit', compact('atSoftware', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateATSoftwareRequest $request, ATSoftware $atSoftware)
    {
        $atSoftware->update($request->validated());
        
        return redirect()->route('at-software.show', $atSoftware)
            ->with('success', 'Software updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ATSoftware $atSoftware)
    {
        $atSoftware->delete();
        
        return redirect()->route('at-software.index')
            ->with('success', 'Software deleted successfully.');
    }
}
