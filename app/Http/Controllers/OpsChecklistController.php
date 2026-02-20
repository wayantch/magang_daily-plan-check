<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpsChecklistController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $templates = ChecklistTemplate::with('equipment.room.area')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($template) use ($today) {
                $template->is_done_today = $template->checklists()
                    ->where('check_date', $today)
                    ->exists();

                return $template;
            });

        return view('ops.checklists.index', compact('templates'));
    }

    public function create(ChecklistTemplate $template)
    {
        $template->load('equipment.room.area', 'items');

        return view('ops.checklists.create', compact('template'));
    }

    public function store(Request $request, ChecklistTemplate $template)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.status' => 'required|in:fault,fault_free',
            'items.*.note'   => 'nullable|string',
        ]);

        $checklist = Checklist::create([
            'checklist_template_id' => $template->id,
            'user_id' => Auth::id(),
            'check_date' => now()->toDateString(),
        ]);

        foreach ($request->items as $templateItemId => $item) {
            $checklist->items()->create([
                'checklist_item_template_id' => $templateItemId,
                'status' => $item['status'],
                'note' => $item['note'] ?? null,
            ]);
        }

        return redirect()
            ->route('ops.checklists.index')
            ->with('success', 'Checklist submitted successfully');
    }
}
