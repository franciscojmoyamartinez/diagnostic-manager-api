<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['diagnostic', 'description','date_diagnostic','patientId'];

    public function Diagnostic()
    {
        // laravel assumes user_id as foreign and local key.
        return $this->belongsTo('App\Models\Patient');
    }



}
