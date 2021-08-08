<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{
    public function post(Article $slug)
    {
        return view("blog.post", compact("slug"));
    }
}
