<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'body',
        'image',
        'year',
        'link',
        'actors',
        'producer',
        'user_id',
        'view_count',
        'download_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}