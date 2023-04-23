<?php

namespace App\Http\Controllers\Blog;

use App\Http\{Controllers\Controller, Helper\UploadFile};
use App\Models\{Article, User};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class BlogController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::where(function ($query) use ($request) {
            $query->where("title", "like", "%{$request->input('q')}%")->orWhere("content", "like", "%{$request->input('q')}%");
        })->with('user:id,name,image')->where(Article::TYPE, "blog")->orderby("id", "DESC")->paginate();

        return view("blog", compact("articles"));
    }

    public function post(Article $slug)
    {
        return view("blog.post", compact("slug"));
    }

    public function profile(User $user)
    {
        return view('profile', compact('user'));
    }

    public function profileSave(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            "image" => ["image", "max:2048", "nullable"],
        ]);

        if ($request->has('image')) {
            @unlink('upload/profile/' . $user->image);
        }

        $user->update([
            'image' => (new UploadFile($request->file(Article::IMAGE), "upload/profile/"))->fileName
        ]);

        $user->setMeta('profile_name', $request->input('name'));
        $user->setMeta('profile_about', $request->input('about'));
        $user->setMeta('profile_phone', $request->input('phone'));
        $user->setMeta('profile_mail', $request->input('mail'));

        return back();
    }
}
