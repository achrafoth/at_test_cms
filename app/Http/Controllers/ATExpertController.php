<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreATExpertRequest;
use App\Http\Requests\UpdateATExpertRequest;
use App\Models\ATExpert;
use Illuminate\Http\Request;

class ATExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atExperts = ATExpert::all();
        return view('at-experts.index', compact('atExperts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('at-experts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreATExpertRequest $request)
    {
        $atExpert = ATExpert::create($request->validated());
        return redirect()->route('at-experts.show', $atExpert)->with('success', 'AT Expert created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ATExpert $atExpert)
    {
        return view('at-experts.show', compact('atExpert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ATExpert $atExpert)
    {
        return view('at-experts.edit', compact('atExpert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateATExpertRequest $request, ATExpert $atExpert)
    {
        $atExpert->update($request->validated());
        return redirect()->route('at-experts.show', $atExpert)->with('success', 'AT Expert updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ATExpert $atExpert)
    {
        $atExpert->delete();
        return redirect()->route('at-experts.index')->with('success', 'AT Expert deleted successfully.');
    }
}
