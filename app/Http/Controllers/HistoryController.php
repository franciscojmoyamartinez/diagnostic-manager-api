<?php

namespace App\Http\Controllers;

use App\Models\History;

use Illuminate\Http\Request;

class HistoryController extends Controller
{   
    /**
     * Get all History by Patient Id
     * @param  int  $patientId
     * @return History
     */

    public function index($patientId)
    {
        return History::where('patientId',$patientId)->get();
    }
}
