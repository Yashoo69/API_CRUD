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
        $validator = Validator::make($request->all(), Result::rules());
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Result::with(['race.circuit'])->find($id);
        if ($result){
            return new ResultResource($result); // return Response($driver);
        }
        return response()->json("Result not found", 404);
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
        $result = Result::find($id);
        if($result){
            $validator = Validator::make($request->all(), Result::rules(true, $request->all(), $id));
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $result = $result->updateResult($request->all());
            return response()->json('Result succefully updated', 200);
        }
        return response()->json('Result not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $result = Result::find($id);
        if($result){
            $result->delete();
            return response()->json('Result succefully deleted', 204);
        }
        return response()->json('Result not found', 404);
    }
}
