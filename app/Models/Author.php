<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'bio',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
