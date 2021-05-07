<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'governmentId'];

    public function diagnostics(){
        return $this->hasMany('App\Models\Diagnostic');
    }
}
