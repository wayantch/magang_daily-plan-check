<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Area;
use App\Models\Type;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['area', 'type'])->latest()->paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $areas = Area::where('has_room', true)
            ->where('is_active', true)
            ->get();

        $types = Type::where('is_active', true)->get();

        return view('rooms.create', compact('areas', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'area_id'   => 'required|exists:areas,id',
            'type_id'      => 'required|exists:types,id',
            'name'      => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Room::create($data);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room created successfully');
    }

    public function edit(Room $room)
    {
        $areas = Area::where('has_room', true)
            ->where('is_active', true)
            ->get();

        return view('rooms.edit', compact('room', 'areas'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'area_id'   => 'required|exists:areas,id',
            'name'      => 'required|string|max:255',
            'type'      => 'required|in:critical,non-critical',
            'is_active' => 'required|boolean',
        ]);

        $room->update($data);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }
}
