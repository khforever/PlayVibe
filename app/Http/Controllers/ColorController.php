<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return view('dashboard.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //validation
        $validated = $request->validate([
            'color' => 'required|string|max:50',
            'code' => 'required|string|max:7|unique:colors,code',
        ]);

        Color::create($validated);

        return redirect()->route('colors.index')->with('success', 'Color created successfully');
     }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color , $id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect()->route('colors.index')->with('success', 'Color deleted successfully');
    }
}
