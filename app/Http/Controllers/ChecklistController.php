<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Area;
use App\Models\Room;
use App\Models\Equipment;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::with(['area', 'room', 'items'])
            ->latest('check_date')
            ->paginate(10);

        return view('checklists.index', compact('checklists'));
    }

    // User input form
    public function myIndex()
    {
        $checklists = Checklist::with(['area', 'room'])
            ->where('user_id', auth()->id())
            ->latest('check_date')
            ->paginate(10);

        return view('checklists.user.index', compact('checklists'));
    }


    public function create()
    {
        $areas = Area::where('is_active', true)->get();

        return view('checklists.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'area_id'                => 'required|exists:areas,id',
            'room_id'                => 'nullable|exists:rooms,id',
            'check_date'             => 'required|date',
            'items'                  => 'required|array',
            'items.*.equipment_id'   => 'required|exists:equipments,id',
            'items.*.condition'      => 'required|in:normal,abnormal,not_working',
            'items.*.note'           => 'nullable|string',
        ]);

        $checklist = Checklist::create([
            'user_id'   => auth()->id(),
            'area_id'   => $data['area_id'],
            'room_id'   => $data['room_id'] ?? null,
            'check_date' => $data['check_date'],
            'status'    => 'submitted',
        ]);

        foreach ($data['items'] as $item) {
            ChecklistItem::create([
                'checklist_id' => $checklist->id,
                'equipment_id' => $item['equipment_id'],
                'condition'    => $item['condition'],
                'note'         => $item['note'] ?? null,
            ]);
        }

        return redirect()
            ->route('checklist.create')
            ->with('success', 'Checklist submitted');
    }
}
