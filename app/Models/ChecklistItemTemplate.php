<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistItemTemplate extends Model
{
    protected $fillable = [
        'checklist_template_id',
        'heading',
        'subheading',
    ];

    public function template()
    {
        return $this->belongsTo(ChecklistTemplate::class, 'checklist_template_id');
    }
}
