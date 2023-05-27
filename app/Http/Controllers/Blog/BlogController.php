<?php

namespace App\Http\Controllers\Blog;

use App\Http\{Controllers\Controller};
use App\Models\{Article, Category, User};
use Illuminate\Http\Request;


class BlogController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::where(function ($query) use ($request) {
            $query->where("title", "like", "%{$request->input('q')}%")->orWhere("content", "like", "%{$request->input('q')}%");
        })->with('user:id,name,image','category:id,title')->where(Article::TYPE, "blog")->orderby("id", "DESC")->paginate();

        return view("blog.index", compact("articles"));
    }

    public function post($slug)
    {
        $article = Article::where(Article::SLUG, $slug)->firstOrFail();

        $nextPost = Article::where([
            ['created_at', '>', $article->created_at],
            [Article::TYPE,'blog']
        ])->orderBy('created_at', 'asc')
            ->first();

        $prevPost = Article::where([
            ['created_at', '<', $article->created_at],
            [Article::TYPE,'blog']
        ])->orderBy('created_at', 'desc')
            ->first();

        return view("blog.post", compact("article", 'nextPost', 'prevPost'));
    }

    public function profile(User $user)
    {
        return view('profile', compact('user'));
    }

    public function categoryPosts(Request $request, Category $category)
    {
        $categoryIds = $category->children->pluck('id');
        $categoryIds[]=$category->id;

        $articles = Article::whereIn(Article::CATEGORY_ID, $categoryIds)
            ->where(function ($query) use ($request) {
                $query->where("title", "like", "%{$request->input('q')}%")->orWhere("content", "like", "%{$request->input('q')}%");
            })->with('user:id,name,image', 'category:id,title')->where(Article::TYPE, "blog")->orderby("id", "DESC")->paginate();

        return view("blog.index", compact("articles"));
    }
}
