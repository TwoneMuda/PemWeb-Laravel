<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id',
        'category_id',
        'created_at',
        'thumbnail',
        'status',
        'rejection_note',
    ];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    
}
