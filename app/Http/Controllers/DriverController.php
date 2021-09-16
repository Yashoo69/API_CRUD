<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            return Response(Driver::all());
        } else {
            return Response(Driver::filterDriver($request->all()));
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
            'driverRef' => 'required|string|max:255',
            'forename' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number' => 'integer|max:11',
            'code' => 'string|max:255',
            'dob' => 'date', 
            'nationality' => 'string|max:255',
            'url' => 'required|unique:drivers|string|max:255',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }

        $driver = new Driver();
        $driver = $driver->createDriver($request->all());



        return response()->json($driver, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::find($id);

        if ($driver){

            return new DriverResource($driver);
            // return Response($driver);
        }
        return response()->json("Driver not found", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)

    {
        $validator = Validator::make($request->all(), [
            'driverRef' => 'required|string|max:255',
            'forename' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number' => 'integer|max:11',
            'code' => 'string|max:255',
            'dob' => 'date', 
            'nationality' => 'string|max:255',
            'url' => 'required|unique:drivers|string|max:255',
        ]);

        if ($validator->fails()) {
          
            return response()->json($validator->errors(), 400);
                                  
        }
        
        $driver = $driver->updateDriver($request->all());

        return response()->json($driver, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return response()->json('', 204);
    }

    public function search($surname)
    {

        return Driver::where('surname', 'like','%'. $surname. '%')->get();
    }



}


