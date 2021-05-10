<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'governmentId','clinicId'];

    public function diagnostics(){
        return $this->hasMany('App\Models\Diagnostic');
    }

    public function history(){
        return $this->hasMany('App\Models\History');
    }
    public function clinic()
    {
        // laravel assumes user_id as foreign and local key.
        return $this->belongsTo('App\Models\Clinic');
    }
}
