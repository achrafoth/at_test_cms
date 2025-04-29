<?php

namespace App\Http\Controllers;

use App\Models\ATEquipment;
use App\Models\ATEquipmentItem;
use Illuminate\Http\Request;

class ATEquipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ATEquipment $atEquipment)
    {
        $items = $atEquipment->items()->paginate(10);
        
        return view('at-equipment-items.index', compact('atEquipment', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ATEquipment $atEquipment)
    {
        return view('at-equipment-items.create', compact('atEquipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ATEquipment $atEquipment)
    {
        $validated = $request->validate([
            'serial_number' => 'nullable|string|max:255',
            'purchase_value' => 'required|numeric|min:0',
            'status' => 'required|in:available,loan,provision,procured',
            'notes' => 'nullable|string',
        ]);
        
        $item = $atEquipment->items()->create($validated);
        
        return redirect()->route('at-equipment.items.show', [$atEquipment, $item])
            ->with('success', 'Equipment item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ATEquipment $atEquipment, ATEquipmentItem $item)
    {
        return view('at-equipment-items.show', compact('atEquipment', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ATEquipment $atEquipment, ATEquipmentItem $item)
    {
        return view('at-equipment-items.edit', compact('atEquipment', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ATEquipment $atEquipment, ATEquipmentItem $item)
    {
        $validated = $request->validate([
            'serial_number' => 'nullable|string|max:255',
            'purchase_value' => 'required|numeric|min:0',
            'status' => 'required|in:available,loan,provision,procured',
            'notes' => 'nullable|string',
        ]);
        
        $item->update($validated);
        
        return redirect()->route('at-equipment.items.show', [$atEquipment, $item])
            ->with('success', 'Equipment item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ATEquipment $atEquipment, ATEquipmentItem $item)
    {
        $item->delete();
        
        return redirect()->route('at-equipment.items.index', $atEquipment)
            ->with('success', 'Equipment item deleted successfully.');
    }
}
