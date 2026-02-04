<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'name',
        'type_id',
        'is_active',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
