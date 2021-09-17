<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $primaryKey ='resultId';

    protected $fillable = [
        'raceId',
        'driverId',
        'constructorId',
        'number',
        'grid',
        'position',
        'positiontext',
        'positionOrder',
        'points',
        'laps',
        'time',
        'milliseconds',
        'fastestLap',
        'rank',
        'fastestLapTime',
        'fastestLapSpeed',
    ];

    protected $hidden = ["created_at", "updated_at"];

    public function race(){
        return $this->belongsTo(Race::class, 'raceId');
    }

    public function driver(){
        return $this->belongsTo(Driver::class, 'driverId');
    }

    public function constructor(){
        return $this->belongsTo(Constructor::class, 'constructorId');
    }

    public function createResult($data) {
        $result = Result::create($data);
        $result->save();
        return Result::find($result->resultId);
    }

    public function updateResult($data) {
        $this->update($data);
    }

    static function filterResult($data) {
        $query = Result::with(['race.circuit']);
        foreach($data as $key => $value){
            if($key === "sort"){
                $query->orderBy($value);
            } elseif($key === "desc"){
                $query->orderByDesc($value);
            } elseif($key === "paginate"){
                $query->paginate(intval($value));
            } elseif($key != 'page') {
                $query->where($key, $value);
            }
        }
        $results = $query->get();
        return $results;
    }

    static function rules($update = false,  $data = [], $id = 0){
        $rules = [
            'raceId' => 'required|integer|exists:races,raceId',
            'driverId' => 'required|integer|exists:drivers,driverId',
            'constructorId' => 'required|integer|exists:constructors,constructorId',
            'grid' => 'required|integer',
            'positionOrder' => 'required|integer',
            'positiontext' => 'required|string|max:255',
            'points' => 'required|numeric',
            'laps' => 'required|integer',
            'time' => 'nullable|string|max:255',
            'number' => 'nullable|integer',
            'position' => 'nullable|integer',
            'milliseconds' => 'nullable|integer',
            'fastestLap' => 'nullable|integer',
            'rank' => 'nullable|integer',
            'fastestLapTime' => 'nullable|string|max:255',
            'fastestLapSpeed' => 'nullable|string|max:255',
        ];
        if($update) {
            $customRules = [];
            foreach(array_keys($data) as $key){
                if(array_key_exists($key, $rules)){
                    $customRules[$key] = $rules[$key];
                }
            }
            return $customRules;
        } else {
            return $rules;
        }
    }
}
