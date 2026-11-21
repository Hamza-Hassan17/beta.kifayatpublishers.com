<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'phone',
        'email',
        'class_id',
        'school_id'
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
