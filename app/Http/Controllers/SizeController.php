<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        return view('dashboard.sizes.index', compact('sizes'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
    'size' => 'required|string|max:50',

    ]);

    Size::create($validated);
    return redirect()->route('sizes.index')->with('success', 'Size created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size, $id)
    {
        $size=Size::find($id);
        $size->delete();
        return redirect()->route('sizes.index')->with('success', 'Size deleted successfully');
    }
}
