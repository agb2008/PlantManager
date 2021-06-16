<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seedling extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'manufacturer_id',
        'amount',
        'img_id',
        'notes',
        'price',
        'purchase_date',
        'plant_date',
        'seeds_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
