<?php

namespace Modules\TimeSheet\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\TimeSheet\Models\WorkSpace;
use function Couchbase\basicDecoderV1;

class WorkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $workSpaces = WorkSpace::where(WorkSpace::USER_ID, Auth::id())->get();
        return view("TimeSheet::work_space.index", compact("workSpaces"));
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
    public function store(Request $request)
    {
        $valid = $this->checkValid($request);

        WorkSpace::create($valid);

        return back()->with("msg", "فضای کاری موردنظر با موفقیت ثبت شد.");
    }

    /**
     * @param WorkSpace $workSpace
     * @return WorkSpace
     */
    public function show(WorkSpace $workSpace): WorkSpace
    {
        return $workSpace;
    }

    /**
     * @param Request $request
     * @param WorkSpace $workSpace
     * @return Application|Factory|View
     */
    public function edit(Request $request, WorkSpace $workSpace)
    {
        $this->validUser($workSpace);

        $fromDate = $request->input("from") ?? Carbon::now();
        $toDate = $request->input("to") ?? Carbon::now();

        $timeSheets = $workSpace->timeSheet()
            ->whereDate("created_at", "<=", $toDate)
            ->whereDate("created_at", ">=", $fromDate)
            ->get();

        return view("TimeSheet::work_space.time", compact("timeSheets", "workSpace", "fromDate", "toDate"));
    }

    /**
     * @param Request $request
     * @param WorkSpace $workSpace
     * @return RedirectResponse
     */
    public function update(Request $request, WorkSpace $workSpace): RedirectResponse
    {
        $this->validUser($workSpace);

        $valid = $this->checkValid($request);

        $workSpace->update($valid);

        return back()->with("msg", "فضای کاری موردنظر با موفقیت ویرایش شد.");
    }

    /**
     * @param WorkSpace $workSpace
     * @return RedirectResponse
     */
    public function destroy(WorkSpace $workSpace): RedirectResponse
    {
        $this->validUser($workSpace);

        $workSpace->delete();
        return back()->with("msg", "فضای کاری موردنظر با موفقیت حذف شد.");
    }

    /**
     * @param Request $request
     * @return array
     */
    public function checkValid(Request $request): array
    {
        $valid = $request->validate([
            WorkSpace::TITLE => ['required'],
            WorkSpace::PRICE => ['required', "numeric"]
        ]);

        $valid[WorkSpace::USER_ID] = Auth::id();
        return $valid;
    }

    /**
     * @param WorkSpace $workSpace
     */
    private function validUser(WorkSpace $workSpace): void
    {
        if ($workSpace->user_id != Auth::id())
            abort(404);
    }
}
