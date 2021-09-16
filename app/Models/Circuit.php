<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Race::class);
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
        $query = Circuit::query();
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
}

