<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreATEquipmentRequest;
use App\Http\Requests\UpdateATEquipmentRequest;
use App\Models\ATEquipment;
use App\Models\ATCategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ATEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atEquipment = ATEquipment::with(['category', 'supplier'])->get();
        return view('at-equipment.index', compact('atEquipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ATCategory::all();
        $suppliers = Supplier::all();
        return view('at-equipment.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreATEquipmentRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipment', 'public');
        }
        
        $atEquipment = ATEquipment::create($data);
        return redirect()->route('at-equipment.show', $atEquipment)->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ATEquipment $atEquipment)
    {
        return view('at-equipment.show', compact('atEquipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ATEquipment $atEquipment)
    {
        $categories = ATCategory::all();
        $suppliers = Supplier::all();
        return view('at-equipment.edit', compact('atEquipment', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateATEquipmentRequest $request, ATEquipment $atEquipment)
    {
        $data = $request->validated();
        
        if ($request->hasFile('photo')) {
            if ($atEquipment->photo) {
                Storage::disk('public')->delete($atEquipment->photo);
            }
            
            $data['photo'] = $request->file('photo')->store('equipment', 'public');
        }
        
        $atEquipment->update($data);
        return redirect()->route('at-equipment.show', $atEquipment)->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ATEquipment $atEquipment)
    {
        if ($atEquipment->photo) {
            Storage::disk('public')->delete($atEquipment->photo);
        }
        
        $atEquipment->delete();
        return redirect()->route('at-equipment.index')->with('success', 'Equipment deleted successfully.');
    }
}
