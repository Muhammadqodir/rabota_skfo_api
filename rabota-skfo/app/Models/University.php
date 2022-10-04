<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'shortName'
    ];

    public function getUser(){
        return User::where([
            ['role', '=', 'university'],
            ['details', '=', $this->id]
        ])
        ->first();
    }

    public function getRegion(){
        return User::where([
            ['role', '=', 'university'],
            ['details', '=', $this->id]
        ])->getRegion();
    }

    public function getStudentsCount(){
        return count(Student::where('university_id', $this->id)->get());
    }
    
}
