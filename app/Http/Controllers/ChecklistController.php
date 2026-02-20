<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    public function adminIndex()
    {
        $checklists = Checklist::with([
            'template.equipment.room.area',
            'user'
        ])
            ->latest()
            ->paginate(10);

        return view('checklists.index', compact('checklists'));
    }
}
