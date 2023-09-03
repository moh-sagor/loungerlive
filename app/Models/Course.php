<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'body', 'image', 'instructor', 'course_author'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}