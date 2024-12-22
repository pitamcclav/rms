<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::where('owner_id', Auth::id())->get();
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'rent_amount' => 'required|numeric',
        ]);

        Property::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'rent_amount' => $request->rent_amount,
            'status' => 'Available',
            'owner_id' => Auth::id(),
        ]);

        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'rent_amount' => 'required|numeric',
        ]);

        $property = Property::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $property->update($request->all());

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
