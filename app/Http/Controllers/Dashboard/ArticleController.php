<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Helper\Slug;
use App\Http\Helper\UploadFile;
use App\Models\{Article, Categorize, Category};
use App\Http\Controllers\Controller;
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
        $categories = Category::all();
        return view("dashboard.article.create", compact("categories"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $this->checkValid($request);

        $article = Article::create($valid);

        $this->saveCategory($request, $article);

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
        abort(404);
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view("dashboard.article.edit", compact("article", "categories"));
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
        $valid = $this->checkValid($request);

        $article->categorize()->delete();

        if ($request->hasFile(Article::IMAGE))
            unlink(public_path("upload/article/".$article->imageName));

        $article->update($valid);

        $this->saveCategory($request, $article);

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

    /**
     * @param Request $request
     * @return array []|array|int[]|null[]|string[]
     */
    private function checkValid(Request $request): array
    {
        $valid = $request->validate([
            Article::TITLE => ["required"],
            Article::SLUG => ["nullable"],
            Article::TYPE => ["required"],
            Article::IMAGE => ["nullable", "max:2024", "image"],
            Article::CONTENT => ["required"],
            "category" => ["required"],
        ]);

        if ($request->has(Article::IMAGE))
            $valid=array_merge($valid,[
                Article::IMAGE => (new UploadFile($request->file(Article::IMAGE), "upload/article/"))->fileName,
            ]);

        $valid = array_merge($valid, [
            Article::USER_ID => Auth::id(),
            Article::SLUG => $request->input(Article::SLUG) != "" ? $request->input(Article::SLUG) : Slug::slugify($request->input(Article::TITLE)),
        ]);
        return $valid;
    }

    /**
     * @param Request $request
     * @param $article
     */
    private function saveCategory(Request $request, $article): void
    {
        collect($request->input("category"))->map(function ($item) use ($article) {
            $article->categorize()->create([
                Categorize::CATEGORY_ID => $item,
            ]);
        });
    }
}
