<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionNote extends Model
{
    use HasFactory;

    protected $fillable = ['counselor_id', 'user_id', 'note', 'session_date'];

    public function counselor()
    {
        return $this->belongsTo(Counselor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
