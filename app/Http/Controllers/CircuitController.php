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
            return CircuitResource::collection(Circuit::with(['races'])->get())->response();
        } else {
            return CircuitResource::collection(Circuit::filterCircuit($request->all()))->response();
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
        $validator = Validator::make($request->all(),Circuit::rules());
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $circuit = Circuit::with(['races'])->find($id);
        if ($circuit){
            return new CircuitResource($circuit);  //return Response($driver);
        }
        return response()->json("Circuit not found", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $circuit = Circuit::find($id);
        if($circuit){
            $validator = Validator::make($request->all(), Circuit::rules(true, $request->all(), $id));
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $circuit = $circuit->updateCircuit($request->all());
            return response()->json('Circuit succefully updated', 200);
        }
        return response()->json('Circuit not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $circuit = Circuit::find($id);
        if($circuit){
            $circuit->delete();
            return response()->json('Circuit succefully deleted', 204);
        }
        return response()->json('Circuit not found', 404);
    }

    public function search($country)
    {
        return Circuit::where('country', 'like','%'. $country. '%')->get();
    }
}
