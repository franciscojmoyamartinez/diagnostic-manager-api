<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Diagnostic::all();
    }

    /**
     * Display a listing of the resource by patientId.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllDiagnosticByPatientId(Request $request)
    {
        return Diagnostic::where('patient_Id',$request->patientId)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'diagnostic' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:255'
        ]);
        try{
            $diagnostic = Diagnostic::create($request->all());
        }catch (QueryException $e){
            return response()->json(['error' => 'SQL Error patient not exists'], 422);
        }
        History::create([
            'description' => 'Diagnostic created',
            'patientId' => $request->patient_id
        ]);
        return response()->json($diagnostic, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostic $diagnostic)
    {
        return $diagnostic;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnostic $diagnostic)
    {
        $diagnostic->update($request->all());

        return response()->json($diagnostic, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();

        return response()->json(null, 204);
    }
}
