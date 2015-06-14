<?php namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Log;

class HomeController extends Controller {

    public function index()
    {
        return view('blog.home')->withArticles(Blog::all());
    }

}
