<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'isbn',
        'price',
        'author_id',
        'class_id',
        'series_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'student_library', 'book_id', 'user_id');
    }

    public function series(){
        return $this->belongsTo(Series::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function code(){
        
    }
}
