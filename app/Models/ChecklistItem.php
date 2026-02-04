<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'equipment_id',
        'condition', // normal, abnormal, not_working
        'note',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
