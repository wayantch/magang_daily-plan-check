<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Area;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::with(['room.area', 'room',  ])
            ->latest()
            ->paginate(10);

        return view('equipments.index', compact('equipments'));
    }

    public function create()
    {
        $areas = Area::where('is_active', true)->get();
        $rooms = Room::with('area')->where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();

        return view('equipments.create', compact('areas', 'rooms', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id'   => 'nullable|exists:rooms,id',
            'category_id'  => 'required|exists:categories,id',
            'name'      => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Equipment::create($data);

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Equipment created successfully');
    }

    public function edit(Equipment $equipment)
    {
        $areas = Area::where('is_active', true)->get();
        $rooms = Room::where('is_active', true)->get();

        return view('equipments.edit', compact('equipment', 'areas', 'rooms'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'area_id'   => 'required|exists:areas,id',
            'room_id'   => 'nullable|exists:rooms,id',
            'name'      => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        $equipment->update($data);

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Equipment updated successfully');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Equipment deleted successfully');
    }
}
