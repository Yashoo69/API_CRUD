<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResultResource;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            return ResultResource::collection(Result::with(['race.circuit'])->get());
        } else {
            return ResultResource::collection(Result::filterResult($request->all()));
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
            'raceId' => 'required|integer|exists:races,raceId',
            'driverId' => 'required|integer|exists:drivers,driverId',
            'constructorId' => 'required|integer|exists:constructors,constructorId',

            'grid' => 'required|integer|max:11',
            'positionOrder' => 'required|integer|max:11',
            'positiontext' => 'required|string|max:255',
            'points' => 'required|float',
            'laps' => 'required|integer|max:11',
            'time' => 'string|max:255',
            'number' => 'integer/max:11',
            'position' => 'integer/max:11',
            'milliseconds' => 'integer/max:11',
            'fastestLap' => 'integer/max:11',
            'rank' => 'integer/max:11',
            'fastestLapTime' => 'string|max:255',
            'fastestLapSpeed' => 'string|max:255',

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 400);

        }


        $result = new Result();
        $result = $result->createResult($request->all());

        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Result::with(['race.circuit'])->find($id);

        if ($result){

            return new ResultResource($result);
            // return Response($driver);
        }
        return response()->json("Result not found", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {

        $validator = Validator::make($request->all(), [
            'raceId' => 'required|integer|exists:races,raceId',
            'driverId' => 'required|integer|exists:drivers,driverId',
            'constructorId' => 'required|integer|exists:constructors,constructorId',

            'grid' => 'required|integer|max:11',
            'positionOrder' => 'required|integer|max:11',
            'positiontext' => 'required|string|max:255',
            'points' => 'required|float',
            'laps' => 'required|integer|max:11',
            'time' => 'string|max:255',
            'number' => 'integer/max:11',
            'position' => 'integer/max:11',
            'milliseconds' => 'integer/max:11',
            'fastestLap' => 'integer/max:11',
            'rank' => 'integer/max:11',
            'fastestLapTime' => 'string|max:255',
            'fastestLapSpeed' => 'string|max:255',

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 400);

        }

        $result = $result->updateResult($request->all());

        return response()->json($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return response()->json('', 204);
    }
}
