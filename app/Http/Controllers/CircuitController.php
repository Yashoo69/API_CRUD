<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CircuitResource;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            return Response(Circuit::all());
        } else {
            return Response(Circuit::filterCircuit($request->all()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'circuitRef' => 'required|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|unique:circuits|max:255',
            'country' => 'string|max:255', 
            'location' => 'string|max:255', 
            'lat' => 'numeric', 
            'lng' => 'numeric',
            'alt' => 'integer|max:11',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }

        $circuit = new Circuit();
        $circuit = $circuit->createCircuit($request->all());

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
        return response()->json("Circuit not found", 404);
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
        $validator = Validator::make($request->all(), [
            'circuitRef' => 'required|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|unique:circuits|max:255',
            'country' => 'string|max:255', 
            'location' => 'string|max:255', 
            'lat' => 'numeric', 
            'lng' => 'numeric',
            'alt' => 'integer|max:11',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }

        $circuit = $circuit->updateCircuit($request->all());

        return response()->json($circuit, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circuit  $circuit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circuit $circuit)
    {
        $circuit->delete();

        return response()->json('', 204);
    }
    public function search($country)
    {
        return Circuit::where('country', 'like','%'. $country. '%')->get();
    }
}
