<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\ATExpert;
use App\Models\Client;
use App\Models\Session;
use App\Models\TrustedSpecialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Session::with(['client', 'trustedSpecialist', 'atExpert']);
        
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
        $session = Session::create($request->validated());
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        $this->authorizeView($session);
        
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
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
    public function update(UpdateSessionRequest $request, Session $session)
    {
        $this->authorizeView($session);
        
        $session->update($request->validated());
        
        return redirect()->route('sessions.show', $session)
            ->with('success', 'Session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $this->authorizeView($session);
        
        $session->delete();
        
        return redirect()->route('sessions.index')
            ->with('success', 'Session deleted successfully.');
    }
    
    /**
     * Check if the current user is authorized to view/edit/delete the session.
     */
    private function authorizeView(Session $session)
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
