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
        return $this->hasMany(Result::class, 'constructorId');
    }

    public function createConstructor($data) {
        $constructor = Constructor::create($data);
        $constructor->save();
        return $constructor;
    }

    public function updateConstructor($data) {
        $this->update($data);
    }

    static function filterConstructor($data) {
        $query = Constructor::query();
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
        $constructors = $query->get();
        return $constructors;
    }
}
