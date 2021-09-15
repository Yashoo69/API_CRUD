<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    use HasFactory;

    protected $primaryKey ='circuitId';

    protected $hidden = ["created_at", "updated_at"];

    public function races()
    {
        return $this->hasMany(Race::class);
    }
    
}