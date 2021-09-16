<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ConstructorResource;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            return Response(Constructor::all());
        } else {
            return Response(Constructor::filterConstructor($request->all()));
        }    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'constructorRef' => 'required|max:255',
            'name' => 'required|string|unique:constructors|max:255',
            'url' => 'required|string|max:255',
            'nationality' => 'string|max:255',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }

        $constructor = new Constructor();
        $constructor = $constructor->createConstructor($request->all());

        return response()->json($constructor, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $constructor = Constructor::find($id);

        if ($constructor){

            return new ConstructorResource($constructor);
            // return Response($driver);
        }
        return response()->json("Constructor not found", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Constructor $constructor)
    {
        $validator = Validator::make($request->all(), [
            'constructorRef' => 'required|max:255',
            'name' => 'required|string|unique:constructors|max:255',
            'nationality' => 'string|max:255',
            'url' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }

        $constructor = $constructor->updateConstructor($request->all());

        return response()->json($constructor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Constructor $constructor)
    {
        $constructor->delete();

        return response()->json('', 204);
    }
}
