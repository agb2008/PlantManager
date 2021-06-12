<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeds extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number_of_seeds',
        'amount',
        'type_id',
        'manufacturer_id',
        'production_date',
        'expiration_date',
        'harvest_date',
        'notes',
        'price',
        'img_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
