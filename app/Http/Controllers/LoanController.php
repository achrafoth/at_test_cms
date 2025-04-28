<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Client;
use App\Models\ATEquipment;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['client', 'equipment'])->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        return view('loans.create', compact('clients', 'equipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $validated = $request->validated();
        
        $loan = Loan::create($validated);
        
        return redirect()->route('loans.show', $loan)
            ->with('success', 'Equipment loan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $loan->load(['client', 'equipment']);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $clients = Client::all();
        $equipment = ATEquipment::all();
        return view('loans.edit', compact('loan', 'clients', 'equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $validated = $request->validated();
        
        $loan->update($validated);
        
        return redirect()->route('loans.show', $loan)
            ->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        
        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully.');
    }
    
    /**
     * Mark a loan as returned.
     */
    public function markAsReturned(Loan $loan)
    {
        $loan->update([
            'status' => 'returned',
            'actual_return_date' => now(),
        ]);
        
        return redirect()->route('loans.show', $loan)
            ->with('success', 'Loan marked as returned successfully.');
    }
    
    /**
     * Mark a loan as lost.
     */
    public function markAsLost(Loan $loan)
    {
        $loan->update([
            'status' => 'lost',
        ]);
        
        return redirect()->route('loans.show', $loan)
            ->with('success', 'Loan marked as lost successfully.');
    }
}
