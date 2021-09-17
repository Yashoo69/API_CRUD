<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Circuit extends Model
{
    use HasFactory;

    protected $primaryKey ='circuitId';

    protected $fillable = [
        'circuitRef',
        'name',
        'location',
        'country',
        'lat',
        'lng',
        'alt',
        'url',
    ];

    protected $hidden = ["created_at", "updated_at"];

    public function races()
    {
        return $this->hasMany(Race::class, "circuitId");
    }


    public function createCircuit($data) {
        $circuit = Circuit::create($data);
        $circuit->save();
        return Circuit::find($circuit->circuitId);
    }

    public function updateCircuit($data) {
        $this->update($data);
    }

    static function filterCircuit($data) {
        $query = Circuit::with(['races']);
        foreach($data as $key => $value){
            if($key === "sort"){
                $query->orderBy($value);
            } elseif($key === "desc"){
                $query->orderByDesc($value);
            } elseif($key === "paginate"){
                $query->paginate(intval($value));
            } elseif($key !== 'page') {
                $query->where($key, $value);
            }
        }
        $circuits = $query->get();
        return $circuits;
    }

    static function rules($update = false,  $data = [], $id = 0){
        $rules = [
            'circuitRef' => 'required|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|max:255|unique:circuits,url,' . $id . ',circuitId',
            'country' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'alt' => 'nullable|integer',
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

