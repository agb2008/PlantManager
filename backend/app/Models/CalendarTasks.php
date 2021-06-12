<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarTasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'completed_date',
        'active',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
