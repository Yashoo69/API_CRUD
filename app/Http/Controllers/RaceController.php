<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
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
            return Response(RaceResource::collection(Race::with(['circuit'])->get()));
        } else {
            return Response(RaceResource::collection(Race::filterRace($request->all())));
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
        $race = new Race();
        $race->createRace($request->all());

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
            return new RaceResource($race);
            // return Response($driver);
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
        $race->updateRace($request->all());

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
