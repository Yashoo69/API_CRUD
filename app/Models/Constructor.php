<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use HasFactory;

    protected $primaryKey ='constructorId';

    protected $fillable = [
        'constructorRef',
        'name',
        'nationality',
        'url',
    ];

    protected $hidden = ["created_at", "updated_at"];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function createConstructor($data) {
        $constructor = Constructor::create($data);
        $constructor->save();
        return $constructor;
    }

    public function updateConstructor($data) {
        $this->update($data);
    }

}
