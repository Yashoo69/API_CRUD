<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use HasFactory;

    protected $primaryKey ='constructorId';

    protected $hidden = ["created_at", "updated_at"];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    
}
