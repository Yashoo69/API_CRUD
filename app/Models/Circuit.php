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
        return $circuit;
    }

    public function updateCircuit($data) {
        $this->update($data);
    }
}
