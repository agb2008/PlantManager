<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    protected $fillable = [
        'posX',
        'posY',
        'plant_id',
        'img_id',
        'user_id',
        'notes',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
