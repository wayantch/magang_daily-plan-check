<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';


    protected $fillable = [
        'room_id',
        'type_id',
        'category_id',
        'name',
        'is_active',
    ];


    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // ✅ RELASI KE TEMPLATE
    public function checklistTemplates()
    {
        return $this->hasMany(ChecklistTemplate::class);
    }

    // ✅ RELASI KE CHECKLIST (LEWAT TEMPLATE)
    public function checklists()
    {
        return $this->hasManyThrough(
            Checklist::class,
            ChecklistTemplate::class
        );
    }
}
