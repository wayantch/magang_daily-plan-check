<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    protected $fillable = [
        'checklist_id',
        'checklist_item_template_id',
        'status',
        'note',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function templateItem()
    {
        return $this->belongsTo(
            ChecklistItemTemplate::class,
            'checklist_item_template_id'
        );
    }
}
