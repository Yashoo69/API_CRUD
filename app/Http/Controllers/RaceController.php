<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RaceResource;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            return RaceResource::collection(Race::with(['circuit'])->get())->response();
        } else {
            return RaceResource::collection(Race::filterRace($request->all()))->response();
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
            'circuitId' => 'required|integer|exists:circuits,circuitId',
            'year' => 'required|integer|max:11',
            'round' => 'required|integer|max:11',
            'name' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'time',
            'url' => 'unique:races',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $race = new Race();
        $race = $race->createRace($request->all());
        return response()->json($race, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $race = Race::with(['circuit'])->find($id);
        if ($race){
            return new RaceResource($race);         // return Response($driver);
        }
        return response()->json("Race not found", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Race $race)
    {
        $validator = Validator::make($request->all(), [
            'circuitId' => 'required|integer|exists:circuits,circuitId',
            'year' => 'required|integer|max:11',
            'round' => 'required|integer|max:11',
            'name' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'time',
            'url' => 'unique:races',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $race = $race->updateRace($request->all());
        return response()->json($race, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function destroy(Race $race)
    {
        $race->delete();
        return response()->json('', 204);
    }
}
