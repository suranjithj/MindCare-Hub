<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['mood_log_id', 'title', 'artist', 'genre', 'url'];

    public function moodLog()
    {
        return $this->belongsTo(MoodLog::class);
    }
}
