<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $primaryKey = 'driverId'; 

    protected $hidden = ['created_at', 'updated_at']; 

    protected $fillable = [
        
    ]; 

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function createDriver($data) {

        
        $this ->driverRef = $data['driverRef']; 
        $this ->forename = $data['forename']; ; 
        $this ->surname = $data['surname']; ; 
        $this ->url = $data['url']; ; 
        $this ->save();
    }

    public function updateDriver($data) {

        $this->update($data);

    }

}
