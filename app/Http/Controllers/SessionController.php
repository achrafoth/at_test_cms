<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\ATEquipment;
use App\Models\ATEquipmentItem;
use App\Models\ATExpert;
use App\Models\ATSoftware;
use App\Models\Client;
use App\Models\ClientSession;
use App\Models\Provision;
use App\Models\SoftwareProvision;
use App\Models\TrustedSpecialist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ClientSession::with(['client', 'trustedSpecialist', 'atExpert']);
        
        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }
        
        if (Auth::user()->hasRole('Trusted Specialist')) {
            $specialist = TrustedSpecialist::where('email', Auth::user()->email)->first();
            if ($specialist) {
                $query->where('trusted_specialist_id', $specialist->id);
            }
        }
        
        if (Auth::user()->hasRole('AT Expert')) {
            $expert = ATExpert::where('email', Auth::user()->email)->first();
            if ($expert) {
                $query->where('at_expert_id', $expert->id);
            }
        }
        
        $sessions = $query->latest()->paginate(10);
        
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $specialists = TrustedSpecialist::all();
        $experts = ATExpert::all();
        $sessionTypes = ['Assessment', 'Training', 'Device Setup', 'Follow-up'];
        
        return view('sessions.create', compact('clients', 'specialists', 'experts', 'sessionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionRequest $request)
    {
        $session = ClientSession::create($request->validated());
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientSession $session)
    {
        $this->authorizeView($session);
        
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientSession $session)
    {
        $this->authorizeView($session);
        
        $clients = Client::all();
        $specialists = TrustedSpecialist::all();
        $experts = ATExpert::all();
        $sessionTypes = ['Assessment', 'Training', 'Device Setup', 'Follow-up'];
        
        return view('sessions.edit', compact('session', 'clients', 'specialists', 'experts', 'sessionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionRequest $request, ClientSession $session)
    {
        $this->authorizeView($session);
        
        $session->update($request->validated());
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientSession $session)
    {
        $this->authorizeView($session);
        
        $session->delete();
        
        return redirect()->route('sessions.index')
            ->with('success', 'Session deleted successfully.');
    }
    
    /**
     * Show the form for adding a provision during a session.
     */
    public function addProvision(ClientSession $session)
    {
        $this->authorizeView($session);
        
        $equipment = ATEquipment::all();
        $equipmentItems = ATEquipmentItem::where('status', 'available')->get();
        
        return view('sessions.add-provision', compact('session', 'equipment', 'equipmentItems'));
    }
    
    /**
     * Store a new provision during a session.
     */
    public function storeProvision(Request $request, ClientSession $session)
    {
        $this->authorizeView($session);
        
        $validated = $request->validate([
            'at_equipment_id' => 'required|exists:a_t_equipment,id',
            'at_equipment_item_id' => 'required|exists:at_equipment_items,id',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $item = ATEquipmentItem::findOrFail($validated['at_equipment_item_id']);
        if ($item->status !== 'available') {
            return back()->withErrors(['error' => 'Selected equipment item is not available.'])
                        ->withInput();
        }
        
        $item->update(['status' => 'provision']);
        
        $provision = new Provision([
            'client_id' => $session->client_id,
            'at_equipment_id' => $validated['at_equipment_id'],
            'at_equipment_item_id' => $validated['at_equipment_item_id'],
            'provision_date' => now(),
            'cost' => $validated['cost'],
            'notes' => $validated['notes'],
        ]);
        
        $provision->save();
        
        $session->provisions()->attach($provision->id);
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Equipment provision added successfully.');
    }
    
    /**
     * Show the form for adding a software provision during a session.
     */
    public function addSoftwareProvision(ClientSession $session)
    {
        $this->authorizeView($session);
        
        $software = ATSoftware::all();
        
        return view('sessions.add-software-provision', compact('session', 'software'));
    }
    
    /**
     * Store a new software provision during a session.
     */
    public function storeSoftwareProvision(Request $request, ClientSession $session)
    {
        $this->authorizeView($session);
        
        $validated = $request->validate([
            'at_software_id' => 'required|exists:a_t_software,id',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $softwareProvision = new SoftwareProvision([
            'client_id' => $session->client_id,
            'at_software_id' => $validated['at_software_id'],
            'provision_date' => now(),
            'cost' => $validated['cost'],
            'notes' => $validated['notes'],
        ]);
        
        $softwareProvision->save();
        
        $session->softwareProvisions()->attach($softwareProvision->id);
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Software provision added successfully.');
    }
    
    /**
     * Show the form for adding a wishlist item during a session.
     */
    public function addWishlistItem(ClientSession $session)
    {
        $this->authorizeView($session);
        
        $equipment = ATEquipment::all();
        $software = ATSoftware::all();
        
        return view('sessions.add-wishlist-item', compact('session', 'equipment', 'software'));
    }
    
    /**
     * Store a new wishlist item during a session.
     */
    public function storeWishlistItem(Request $request, ClientSession $session)
    {
        $this->authorizeView($session);
        
        $validated = $request->validate([
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
        
        $wishlistItem = new WishlistItem([
            'client_id' => $session->client_id,
            'at_equipment_id' => $validated['at_equipment_id'],
            'at_software_id' => $validated['at_software_id'],
            'approximate_value' => $validated['approximate_value'],
            'priority' => $validated['priority'],
            'requested_by' => Auth::id(),
            'notes' => $validated['notes'],
        ]);
        
        $wishlistItem->save();
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Wishlist item added successfully.');
    }
    
    /**
     * Check if the current user is authorized to view/edit/delete the session.
     */
    private function authorizeView(ClientSession $session)
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin') || $user->hasRole('Manager')) {
            return true;
        }
        
        if ($user->hasRole('Trusted Specialist')) {
            $specialist = TrustedSpecialist::where('email', $user->email)->first();
            if (!$specialist || $session->trusted_specialist_id !== $specialist->id) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        if ($user->hasRole('AT Expert')) {
            $expert = ATExpert::where('email', $user->email)->first();
            if (!$expert || $session->at_expert_id !== $expert->id) {
                abort(403, 'Unauthorized action.');
            }
        }
        
        return true;
    }
}
