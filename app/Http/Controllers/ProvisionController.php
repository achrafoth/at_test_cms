<?php

namespace App\Http\Controllers;

use App\Models\Provision;
use App\Models\Client;
use App\Models\ATEquipment;
use App\Models\ATEquipmentItem;
use App\Http\Requests\StoreProvisionRequest;
use App\Http\Requests\UpdateProvisionRequest;
use Illuminate\Http\Request;

class ProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provisions = Provision::with(['client', 'equipment', 'equipmentItem'])->latest()->paginate(10);
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
        
        if (!empty($validated['at_equipment_item_id'])) {
            $equipmentItem = ATEquipmentItem::findOrFail($validated['at_equipment_item_id']);
            $equipmentItem->status = 'provision';
            $equipmentItem->save();
        }
        
        $provision = Provision::create($validated);
        
        return redirect()->route('provisions.show', $provision)
            ->with('success', 'Equipment provisioned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provision $provision)
    {
        $provision->load(['client', 'equipment', 'equipmentItem']);
        return view('provisions.show', compact('provision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provision $provision)
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        
        $equipmentItems = collect();
        if ($provision->at_equipment_id) {
            $equipmentItems = ATEquipmentItem::where('at_equipment_id', $provision->at_equipment_id)
                ->where(function($query) use ($provision) {
                    $query->where('status', 'available')
                        ->orWhere('id', $provision->at_equipment_item_id);
                })
                ->get();
        }
        
        return view('provisions.edit', compact('provision', 'clients', 'equipment', 'equipmentItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvisionRequest $request, Provision $provision)
    {
        $validated = $request->validated();
        
        if ($provision->at_equipment_item_id != $validated['at_equipment_item_id']) {
            if ($provision->at_equipment_item_id) {
                $oldItem = ATEquipmentItem::find($provision->at_equipment_item_id);
                if ($oldItem) {
                    $oldItem->status = 'available';
                    $oldItem->save();
                }
            }
            
            if (!empty($validated['at_equipment_item_id'])) {
                $newItem = ATEquipmentItem::findOrFail($validated['at_equipment_item_id']);
                $newItem->status = 'provision';
                $newItem->save();
            }
        }
        
        $provision->update($validated);
        
        return redirect()->route('provisions.show', $provision)
            ->with('success', 'Provision updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provision $provision)
    {
        if ($provision->at_equipment_item_id) {
            $item = ATEquipmentItem::find($provision->at_equipment_item_id);
            if ($item) {
                $item->status = 'available';
                $item->save();
            }
        }
        
        $provision->delete();
        
        return redirect()->route('provisions.index')
            ->with('success', 'Provision deleted successfully.');
    }
    
    /**
     * Get available equipment items for a specific equipment.
     */
    public function getAvailableItems(Request $request, ATEquipment $equipment)
    {
        $items = $equipment->items()->where('status', 'available')->get();
        return response()->json($items);
    }
}
