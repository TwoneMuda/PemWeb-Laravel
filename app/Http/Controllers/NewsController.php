<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $news = News::query()
        ->where('status', 'published')
        ->when($search, function ($query, $search) {
        $query->where(function ($subQuery) use ($search) { 
            $subQuery->where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%');
        });
        })->latest()
          ->paginate(10)
          ->withqueryString();

        return view('pages.news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::with(['author', 'newsCategory'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('pages.news.show', compact('news'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();

        $news = News::where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(10);


    return view('pages.news.category', compact('category', 'news'));
    }
}
