<?php

namespace App\Http\Controllers;

use App\Models\History;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($patientId)
    {
        return History::where('patientId',$patientId)->get();
    }
}
