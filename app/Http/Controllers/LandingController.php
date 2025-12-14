<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {

        $news = News::with(['author', 'newsCategory']) 
            ->where('status', 'published')     
            ->latest()
            ->paginate(10);

        return view('pages.landing', compact('news'));
    }
}
