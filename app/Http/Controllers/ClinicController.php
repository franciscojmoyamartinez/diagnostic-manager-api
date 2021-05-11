<?php

namespace App\Http\Controllers;

use App\Models\Clinic;

use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Clinic::all();
    }
}
