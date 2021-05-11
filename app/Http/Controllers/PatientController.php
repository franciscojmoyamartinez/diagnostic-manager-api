<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\History;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Patient::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validate
        $validated = $request->validate([
            'fullname' => 'required|min:1|max:255',
            'governmentId' => 'required|min:9',
            'clinicId' => 'required|integer'
        ]);
        try{
            $patient = Patient::create($request->all());
        }catch (QueryException $e){
            return response()->json(['error' => 'The patient already exists'], 422);
        }
        History::create([
            'description' => 'Patient created',
            'patientId' => $patient->id
        ]);
        return response()->json($patient, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient)
    {
        $bearerToken =  Auth::user()->api_token;
        $user = User::where('api_token',$bearerToken)->first();
        $clinic = $user->usersClinic()->get();


        if($patient->clinicId !== $clinic[0]->id){
            return response()->json(['Error' => 'Not authorized'], 401);
        }

        return $patient;
    }

    /**
     * Display a listing of the patients by clinicId.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllPatientsByClinicId(Request $request)
    {
        return Patient::where('clinicId',$request->clinicId)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'fullname' => 'required|min:1|max:255',
            'governmentId' => 'required|min:9'
        ]);
        try{
            $patientUpdated = $patient->update($request->all());
        }catch (QueryException $e){
            return response()->json(['error' => 'The patient already exists'], 422);
        }
        History::create([
            'description' => 'Patient updated',
            'patientId' => $patient->id
        ]);

        return response()->json($patient, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json(null, 204);
    }
}
