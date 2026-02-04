<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'room_id',
        'check_date',
        'status', // submitted, reviewed
    ];

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
