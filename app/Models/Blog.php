<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'body',
        'featured_image',
        'slug',
        'meta_title',
        'meta_description',
        'status',
        'user_id',
        'view_count',
        'link',
        'btn_name',
    ];
    public function category()
    {
        return $this->belongsToMany(Category::class, 'blogs_categories');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}