<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistTemplate;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $totalEquipments = Equipment::count();

        $checkedToday = Checklist::whereDate('created_at', $today)->count();

        $today = Carbon::today();

        $pendingTemplatesToday = ChecklistTemplate::with('equipment.room.area')
            ->where('is_active', true)
            ->whereDoesntHave('checklists', function ($q) use ($today) {
                $q->whereDate('created_at', $today);
            })
            ->get();

        $faultCount = ChecklistItem::where('status', 'fault')
            ->whereHas(
                'checklist',
                fn($q) =>
                $q->whereDate('created_at', $today)
            )->count();

        $faultFreeCount = ChecklistItem::where('status', 'fault_free')
            ->whereHas(
                'checklist',
                fn($q) =>
                $q->whereDate('created_at', $today)
            )->count();

        $pendingCount = $totalEquipments - $checkedToday;

        // ✅ FAULT HARI INI (RECENT TODAY)
        $recentFaults = ChecklistItem::with('checklist.template.equipment.room.area')
            ->where('status', 'fault')
            ->whereHas(
                'checklist',
                fn($q) =>
                $q->whereDate('created_at', $today)
            )
            ->latest()
            ->take(5)
            ->get();

        // ✅ CHECKLIST ACTIVITY HARI INI
        $todayChecklists = Checklist::with('template.equipment', 'user')
            ->whereDate('created_at', $today)
            ->latest()
            ->take(5)
            ->get();

        // ✅ RECENT CHECKLISTS
        $recentChecklists = Checklist::with([
            'template.equipment.room.area',
            'user',
            'items'
        ])
            ->latest()
            ->take(5)
            ->get();

            

        // Category chart
        $categories = Category::pluck('name');
        $faultByCategory = Category::withCount([
            'equipments as fault_count' => function ($q) use ($today) {
                $q->whereHas(
                    'checklists.items',
                    fn($i) =>
                    $i->where('status', 'fault')
                        ->whereDate('created_at', $today)
                );
            }
        ])->pluck('fault_count');

        $faultByCategoryToday = ChecklistItem::where('status', 'fault')
            ->whereHas('checklist', function ($q) use ($today) {
                $q->whereDate('created_at', $today);
            })
            ->whereHas('checklist.template.equipment.category')
            ->with('checklist.template.equipment.category')
            ->get()
            ->groupBy(function ($item) {
                return $item->checklist
                    ->template
                    ->equipment
                    ->category
                    ->name;
            })
            ->map(function ($group) {
                return $group->count();
            });

        return view('dashboard', compact(
            'totalEquipments',
            'checkedToday',
            'faultCount',
            'faultFreeCount',
            'pendingCount',
            'categories',
            'faultByCategory',
            'faultByCategoryToday',
            'recentFaults',
            'todayChecklists',
            'recentChecklists',
            'pendingTemplatesToday'
        ));
    }
}
