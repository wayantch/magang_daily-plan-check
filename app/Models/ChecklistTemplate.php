<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistTemplate extends Model
{
    protected $fillable = [
        'equipment_id',
        'title',
        'description',
        'is_active',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function items()
    {
        return $this->hasMany(ChecklistItemTemplate::class);
    }
    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }
    
}
