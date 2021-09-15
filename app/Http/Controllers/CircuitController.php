<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use Illuminate\Http\Request;
use App\Http\Resources\CircuitResource;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response(Circuit::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $circuit = new Circuit(); 
        $circuit->createCircuit($request->all()); 
   
        

        return response()->json($circuit, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circuit  $circuit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $circuit = Circuit::find($id);

        if ($circuit){

            return new CircuitResource($circuit);
            // return Response($driver); 
        }
        return response()->json(" T'es qu'une merde ", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Circuit  $circuit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Circuit $circuit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circuit  $circuit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circuit $circuit)
    {
        //
    }
}
