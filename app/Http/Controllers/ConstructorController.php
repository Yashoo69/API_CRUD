<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;
use App\Http\Resources\ConstructorResource;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response(Constructor::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $constructor = new Constructor(); 
        $constructor->createConstructor($request->all()); 

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
        return response()->json(" T'es qu'une merde ", 404);
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
        $constructor->updateConstructor($request->all());

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
