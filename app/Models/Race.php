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
        return $race;
    }

    public function updateRace($data) {
        $this->update($data);
    }
}

