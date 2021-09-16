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
        return Driver::find($driver->driverId);
    }

    public function updateDriver($data) {
        $this->update($data);
    }

    static function filterDriver($data) {
        $query = Driver::query();
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
        $drivers = $query->get();
        return $drivers;
    }
}
