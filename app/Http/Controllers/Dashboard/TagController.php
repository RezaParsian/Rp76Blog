<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Slug;
use App\Models\Tag;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    private $path = "dashboard.tag.";

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $tags = Tag::where(Tag::TITLE, "like", "%" . $request->input("name") . "%")->paginate();
        return view($this->path . "index", compact("tags"));
    }

    /**
     *
     */
    public function create()
    {
        abort(404);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            Tag::TITLE => ["required"],
            Tag::SLUG => ["nullable", "unique:tags"]
        ]);

        Tag::create([
            Tag::TITLE => $request->input(Tag::TITLE),
            Tag::SLUG => is_null($request->input(Tag::SLUG)) ? Slug::slugify($request->input(Tag::TITLE)) : Slug::slugify($request->input(Tag::SLUG)),
        ]);

        return back()->with("msg", "دسته بندی موردنظر با موفقیت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * @param Tag $tag
     */
    public function edit(Tag $tag)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * @param Tag $tag
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return back()->with("msg", "تگ موردنظر حذف شد");
    }
}
