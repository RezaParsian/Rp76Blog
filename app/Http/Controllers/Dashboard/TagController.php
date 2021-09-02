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
        $this->tagValidator($request);

       $tag= Tag::create([
            Tag::TITLE => $request->input(Tag::TITLE),
            Tag::SLUG => is_null($request->input(Tag::SLUG)) ? Slug::slugify($request->input(Tag::TITLE)) : Slug::slugify($request->input(Tag::SLUG)),
        ]);

        return back()->with("msg", "تگ موردنظر با موفقیت ثبت شد.");
    }

    /**
     * @param Tag $tag
     * @return Tag
     */
    public function show(Tag $tag): Tag
    {
        return $tag;
    }

    /**
     * @param Tag $tag
     */
    public function edit(Tag $tag)
    {
        abort(404);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {
        $this->tagValidator($request);

        $tag->update([
            Tag::TITLE => $request->input(Tag::TITLE),
            Tag::SLUG => is_null($request->input(Tag::SLUG)) ? Slug::slugify($request->input(Tag::TITLE)) : Slug::slugify($request->input(Tag::SLUG)),
        ]);

        return back()->with("msg", "تگ موردنظر با موفقیت ویرایش شد.");
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

    public function apiTagCreate(Request $request)
    {
        $this->tagValidator($request);

        return Tag::create([
            Tag::TITLE => $request->input(Tag::TITLE),
            Tag::SLUG => is_null($request->input(Tag::SLUG)) ? Slug::slugify($request->input(Tag::TITLE)) : Slug::slugify($request->input(Tag::SLUG)),
        ]);
    }

    /**
     * @param Request $request
     */
    private function tagValidator(Request $request): void
    {
        $request->validate([
            Tag::TITLE => ["required"],
            Tag::SLUG => ["nullable", "unique:tags"]
        ]);
    }
}
