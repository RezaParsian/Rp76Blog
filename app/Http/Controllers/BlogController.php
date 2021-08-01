<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function post(Article $slug)
    {
        return view("blog.post",compact("slug"));
    }
}
