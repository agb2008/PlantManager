<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    use HasFactory;

    protected $fillable = [
        'species_id',
        'companion_id',
        'type',
        'description',
    ];
}
