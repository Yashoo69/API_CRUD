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
        return $this->hasMany(Result::class, 'driverId');
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

    static function rules($update = false,  $data = [], $id = 0){
        $rules = [
            'driverRef' => 'required|string|max:255',
            'forename' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'number' => 'integer|max:11',
            'code' => 'string|max:255',
            'dob' => 'date',
            'nationality' => 'string|max:255',
            'url' => 'required|string|max:255|unique:drivers,url,' . $id . ',driverId',
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
