<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'user_id',
    ];

    public function blog()
    {
        return $this->belongsToMany(Blog::class, 'blogs_categories'); // (model, pivot table name)

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}