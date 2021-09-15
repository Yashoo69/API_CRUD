<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $primaryKey ='resultId';

    protected $hidden = ["created_at", "updated_at"];

    public function race(){
        return $this->belongsTo(Race::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function constructor(){
        return $this->belongsTo(Constructor::class);
    }

    public function createResult($data) {
        $result = Result::create($data);
        $result->save();
        return $result;
    }

    public function updateResult($data) {
        $this->update($data);
    }
}
