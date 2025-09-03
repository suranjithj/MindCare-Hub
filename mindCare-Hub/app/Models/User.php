<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Appointment;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function counselor()
    {
        return $this->hasOne(Counselor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
