<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    public function clinicsUsers(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function patients(){
        return $this->hasMany('App\Models\Patient');
    }
}
