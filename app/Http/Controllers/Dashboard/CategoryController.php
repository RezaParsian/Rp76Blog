<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Slug;
use App\Models\Category;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse, Http\Request, Http\Response, Support\Str};
use Exception;

class CategoryController extends Controller
{
    private $path="dashboard.category.";

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        return view($this->path."index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            Category::TITLE => ["required"],
            Category::TYPE => ["nullable"],
            Category::PARENT_ID => ["required", "numeric"],
            Category::SLUG => ["nullable"]
        ]);

        $valid[Category::SLUG] = is_null($request->input(Category::SLUG)) ? Slug::slugify($request->input(Category::TITLE)) : Slug::slugify($request->input(Category::SLUG));

        Category::create($valid);

        return back()->with("msg", "دسته موردنظر با موفقیت ایجاد شد.");
    }

    /**
     * Show the data for api in dashboard not public
     * @param Category $category
     * @return Category
     */
    public function show(Category  $category): Category
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $valid = $request->validate([
            Category::TITLE => ["required"],
            Category::TYPE => ["nullable"],
            Category::PARENT_ID => ["required", "numeric"],
            Category::SLUG => ["nullabel"]
        ]);

        $valid[Category::SLUG] = is_null($request->input(Category::SLUG)) ? Slug::slugify($request->input(Category::TITLE)) : Slug::slugify($request->input(Category::SLUG));

        $category->update($valid);
        return back()->with("msg", "دسته موردنظر با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with("msg", "دسته موردنظر با موفقیت غیرفعال شد");
    }
}
