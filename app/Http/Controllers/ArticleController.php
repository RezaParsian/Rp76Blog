<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse, Http\Request, Http\Response, Routing\Redirector, Support\Facades\Auth};
use Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $articles = Article::limit(200)->get();
        return view("dashboard.article.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("dashboard.article.create");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            Article::TITLE => ["required"],
            Article::SLUG => ["required"],
            Article::TYPE => ["required"],
            Article::IMAGE => ["nullable", "max:2024", "image"],
            Article::CONTENT => ["required"],
//            "category" => ["required"],
        ]);

        $valid = array_merge($valid, [Article::USER_ID => Auth::id()]);

        $article = Article::create($valid);

        return redirect(route("article.edit", $article->id))->with("msg", "مقاله موردنظر با موفقت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    public function edit(Article $article)
    {
        return view("dashboard.article.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $valid = $request->validate([
            Article::TITLE => ["required"],
            Article::SLUG => ["required"],
            Article::TYPE => ["required"],
            Article::IMAGE => ["nullable", "max:2024", "image"],
            Article::CONTENT => ["required"],
//            "category" => ["required"],
        ]);

        $article->update($valid);

        Cache::pull("");

        return redirect(route("article.edit", $article->id))->with("msg", "مقاله موردنظر با موفقت ثبت شد.");
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return back()->with("msg", "مقاله موردنظر با موفقیت حذف شد.");
    }
}
