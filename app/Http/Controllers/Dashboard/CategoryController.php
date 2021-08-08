<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\{Contracts\Foundation\Application, Contracts\View\Factory, Contracts\View\View, Http\RedirectResponse, Http\Request, Http\Response, Support\Str};
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        return view("dashboard.category.index", compact("categories"));
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
            Category::SLUG => ["required"]
        ]);

        $valid[Category::SLUG] = Str::slug($valid[Category::SLUG]);

        Category::create($valid);

        return back()->with("msg", "دسته موردنظر با موفقیت ایجاد شد.");
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
            Category::SLUG => ["required"]
        ]);

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
