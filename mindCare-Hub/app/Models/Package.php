<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration'];

    public function userPackages()
    {
        return $this->hasMany(UserPackage::class);
    }
}
