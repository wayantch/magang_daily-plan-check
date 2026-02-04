<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::latest()->paginate(10);
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'has_room'    => 'required|boolean',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        Area::create($data);

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area created successfully');
    }

    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'has_room'    => 'required|boolean',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        $area->update($data);

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area updated successfully');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()
            ->route('areas.index')
            ->with('success', 'Area deleted successfully');
    }
}
