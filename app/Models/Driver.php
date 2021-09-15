<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $primaryKey = 'driverId';

    protected $fillable = [
        'driverRef',
        'number',
        'code',
        'forename',
        'surname',
        'dob',
        'nationality',
        'url'
    ];

    protected $hidden = ["created_at", "updated_at"];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function createDriver($data) {
        $driver = Driver::create($data);
        $driver->save();
        return $driver;
    }

    public function updateDriver($data) {
        $this->update($data);
    }
}
