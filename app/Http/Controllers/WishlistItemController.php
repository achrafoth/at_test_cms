<?php

namespace App\Http\Controllers;

use App\Models\ATEquipment;
use App\Models\ATSoftware;
use App\Models\Client;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = WishlistItem::with(['client', 'equipment', 'software', 'requestedByUser'])
                                     ->latest()
                                     ->paginate(10);
        
        $totalValue = WishlistItem::sum('approximate_value');
        
        return view('wishlist-items.index', compact('wishlistItems', 'totalValue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        $software = ATSoftware::all();
        
        return view('wishlist-items.create', compact('clients', 'equipment', 'software'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'at_equipment_id' => 'nullable|exists:a_t_equipment,id',
            'at_software_id' => 'nullable|exists:a_t_software,id',
            'approximate_value' => 'required|numeric|min:0',
            'priority' => 'required|in:low,medium,high',
            'notes' => 'nullable|string',
        ]);
        
        if (empty($validated['at_equipment_id']) && empty($validated['at_software_id'])) {
            return back()->withErrors(['error' => 'Either equipment or software must be selected'])
                        ->withInput();
        }
        
        $validated['requested_by'] = Auth::id();
        
        $wishlistItem = WishlistItem::create($validated);
        
        return redirect()->route('wishlist-items.show', $wishlistItem)
            ->with('success', 'Wishlist item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WishlistItem $wishlistItem)
    {
        return view('wishlist-items.show', compact('wishlistItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WishlistItem $wishlistItem)
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        $software = ATSoftware::all();
        
        return view('wishlist-items.edit', compact('wishlistItem', 'clients', 'equipment', 'software'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WishlistItem $wishlistItem)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'at_equipment_id' => 'nullable|exists:a_t_equipment,id',
            'at_software_id' => 'nullable|exists:a_t_software,id',
            'approximate_value' => 'required|numeric|min:0',
            'priority' => 'required|in:low,medium,high',
            'notes' => 'nullable|string',
        ]);
        
        if (empty($validated['at_equipment_id']) && empty($validated['at_software_id'])) {
            return back()->withErrors(['error' => 'Either equipment or software must be selected'])
                        ->withInput();
        }
        
        $wishlistItem->update($validated);
        
        return redirect()->route('wishlist-items.show', $wishlistItem)
            ->with('success', 'Wishlist item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishlistItem $wishlistItem)
    {
        $wishlistItem->delete();
        
        return redirect()->route('wishlist-items.index')
            ->with('success', 'Wishlist item deleted successfully.');
    }
}
