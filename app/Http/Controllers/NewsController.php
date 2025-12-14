<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug)
    {
        $news = News::with(['author', 'newsCategory'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }
}
