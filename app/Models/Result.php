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
        return $result;
    }

    public function updateResult($data) {
        $this->update($data);
    }

    static function filterResult($data) {
        $query = Result::query();
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
}
