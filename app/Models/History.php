<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'patientId'];

    public function History()
    {
        // laravel assumes user_id as foreign and local key.
        return $this->belongsTo('App\Models\Patient');
    }

    protected $casts = [
        'created_at' => "datetime:Y-m-d\TH:i",
    ];
}
