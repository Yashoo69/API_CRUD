<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $primaryKey ='raceId';

    protected $fillable = [
        'year',
        'round',
        'circuitId',
        'name',
        'date',
        'time',
        'url',
    ];

    protected $hidden = ["created_at", "updated_at"];

    public function circuit(){
        return $this->belongsTo(Circuit::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }


    public function createRace($data) {
        $race = Race::create($data);
        $race->save();
        return Race::find($race->raceId);
    }

    public function updateRace($data) {
        $this->update($data);
    }

    static function filterRace($data) {
        $query = Race::query();
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
        $races = $query->get();
        return $races;
    }

    static function rules($update = false,  $data = [], $id = 0){
        $rules = [
            'circuitId' => 'required|integer|exists:circuits,circuitId',
            'year' => 'required|integer|digits_between:4,4',
            'round' => 'required|integer',
            'name' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'nullable|time',
            'url' => 'nullable|unique:races,url,' . $id . ',raceId',
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

