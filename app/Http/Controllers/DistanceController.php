<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['Distance', true, route('admin.distance.index')],
            ['Index', false],
        ];
        $title = 'All Distance';
        $distances = Distance::latest()->get();
        return view('admin.distance.index', compact('breadcrumbs', 'title', 'distances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['Distance', true, route('admin.distance.index')],
            ['Create', false],
        ];
        $title = 'Create Distance';
        return view('admin.distance.create', compact('breadcrumbs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'length' => 'required|integer'
        ]);

        Distance::create($validated);
        return redirect()->route('admin.distance.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distance $distance)
    {
        $breadcrumbs = [
            ['Distance', true, route('admin.distance.index')],
            ['Edit ' . $distance->id, false],
        ];
        $title = 'Create Distance';
        return view('admin.distance.edit', compact('breadcrumbs', 'title', 'distance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distance $distance)
    {
        $validated = $request->validate([
            'length' => 'required'
        ]);

        $distance->update($validated);
        return redirect()->route('admin.distance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distance $distance)
    {
        $distance->delete();
        return redirect()->back();
    }
}
