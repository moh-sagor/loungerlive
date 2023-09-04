<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'body', 'image', 'instructor', 'course_author', 'view_count', 'link', 'download_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}