<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistTemplate;
use App\Models\Equipment;
use Illuminate\Http\Request;

class ChecklistTemplateController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $templates = ChecklistTemplate::with([
            'equipment.room.area',
            'items',
            'checklists' => function ($q) use ($today) {
                $q->where('check_date', $today);
            }
        ])
            ->latest()
            ->paginate(10);

        return view('checklist-templates.index', compact('templates'));
    }

    public function show(ChecklistTemplate $checklistTemplate)
    {
        $checklistTemplate->load([
            'equipment.room.area',
            'items',
            'checklists' => function ($q) {
                $q->latest()->limit(1);
            },
            'checklists.items.templateItem',
        ]);

        $latestChecklist = Checklist::where('checklist_template_id', $checklistTemplate->id)
            ->latest()
            ->first();


        return view('checklist-templates.show', compact(
            'checklistTemplate',
            'latestChecklist'
        ));
    }

    public function create()
    {
        $equipments = Equipment::with('room.area')
            ->where('is_active', true)
            ->get();

        return view('checklist-templates.create', compact('equipments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'items'        => 'required|array|min:1',
            'items.*.heading'    => 'required|string|max:255',
            'items.*.subheading' => 'required|string|max:255',
        ]);

        $template = ChecklistTemplate::create([
            'equipment_id' => $data['equipment_id'],
            'title'        => $data['title'],
            'description'  => $data['description'] ?? null,
            'is_active'    => true,
        ]);

        foreach ($data['items'] as $item) {
            $template->items()->create($item);
        }

        return redirect()
            ->route('checklist-templates.index')
            ->with('success', 'Checklist template created successfully');
    }

    public function edit(ChecklistTemplate $checklistTemplate)
    {
        $today = now()->toDateString();

        $isLocked = $checklistTemplate->checklists()
            ->where('check_date', $today)
            ->exists();

        if ($isLocked) {
            return redirect()
                ->route('checklist-templates.index')
                ->with('error', 'Template already used today and cannot be edited.');
        }

        $checklistTemplate->load('items', 'equipment.room.area');

        $equipments = Equipment::with('room.area')
            ->where('is_active', true)
            ->get();

        return view('checklist-templates.edit', compact(
            'checklistTemplate',
            'equipments'
        ));
    }

    public function update(Request $request, ChecklistTemplate $checklistTemplate)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'is_active' => 'required|boolean',
        ]);

        $checklistTemplate->update($data);

        return redirect()
            ->route('checklist-templates.index')
            ->with('success', 'Checklist template updated');
    }

    public function destroy(ChecklistTemplate $checklistTemplate)
    {
        $checklistTemplate->delete();

        return redirect()
            ->route('checklist-templates.index')
            ->with('success', 'Checklist template deleted successfully');
    }
}
