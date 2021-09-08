<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{

    public function index(Request $request)
    {
        $articles= Article::where(function ($query) use ($request) {
            $query->where("title", "like", "%{$request->input('q')}%")->orWhere("content", "like", "%{$request->input('q')}%");
        })->with(["user" => function ($query) {
            return $query->select("id", "name");
        }])->where(Article::TYPE, "blog")->orderby("id", "DESC")->paginate();

        return view("welcome",compact("articles"));
    }

    public function post(Article $slug)
    {
        return view("blog.post", compact("slug"));
    }
}
