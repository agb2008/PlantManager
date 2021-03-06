<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'midname',
        'lastname',
        'username',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
      return $this->is_admin;
    }

    public function messages()
    {
      return $this->hasMany(Message::class);
    }

    public function seeds()
    {
        return $this->hasMany(Seed::class);
    }

    public function seedlings()
    {
        return $this->hasMany(Seedling::class);
    }

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }

    public function calendarTasks()
    {
        return $this->hasMany(CalendarTask::class);
    }

    public function position()
    {
        return $this->hasMany(Position::class);
    }

}
