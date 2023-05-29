<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Slug;
use App\Http\Helper\UploadFile;
use App\Models\{Article, Category, Tag};
use Exception;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse, Http\Request, Routing\Redirector, Support\Facades\Auth, Support\Facades\Cache};

class ArticleController extends Controller
{
    private string $path = "dashboard.article.";

    public function __construct()
    {
        $this->middleware("role:posts")->only("index");
        $this->middleware("role:post.create")->only(["create", "store"]);
        $this->middleware("role:post.edit")->only(["edit", "show"]);
        $this->middleware("role:post.delete")->only(["destroy"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $articles = Article::with('category')->orderBy("id", "DESC")->paginate();

        return view($this->path . "index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view($this->path . "create", compact("categories", "tags"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
	{
		$valid = $this->checkValid($request);

		$article = Article::create($valid);

		$article->tags()->sync($request->input('tags'));

		Cache::forget('cats');

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
        $tags = Tag::all();
        return view($this->path . "edit", compact("article", "categories", "tags"));
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
            'title' => ['required'],
            'slug' => ['required'],
            'category_id' => ['required'],
			'content' => ['required']
        ]);

        $article->update($valid);

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
			"category_id" => ["required"],
			"tags" => ["required"]
		]);

		if ($request->has(Article::IMAGE))
			$valid = array_merge($valid, [
				Article::IMAGE => (new UploadFile($request->file(Article::IMAGE), "upload/article/"))->fileName,
			]);

		return array_merge($valid, [
			Article::USER_ID => Auth::id(),
			Article::SLUG => $request->input(Article::SLUG) != "" ? $request->input(Article::SLUG) : Slug::slugify($request->input(Article::TITLE)),
		]);
	}

	/**
	 * @param Request $request
	 * @param Article $article
	 * @return array
	 */
	public function reaction(Request $request, Article $article): array
	{
		$reactions = json_decode(@$article->getMeta('reaction')->value ?? '[]', true);

		$reactions = array_merge($reactions, [$request->input('emoji') => @$reactions[$request->input('emoji')] + 1 ?? 1]);

		$article->setMeta('reaction', json_encode($reactions));

		return $reactions;
	}
}
