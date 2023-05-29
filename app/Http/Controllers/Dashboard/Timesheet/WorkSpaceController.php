<?php

namespace App\Http\Controllers\Dashboard\Timesheet;

use App\Http\Controllers\Controller;
use App\Models\WorkSpace;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkSpaceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function index()
	{
		$workSpaces = WorkSpace::where(WorkSpace::USER_ID, Auth::id())->orderBy('id', 'DESC')->paginate();
		return view('dashboard.work_space.index', compact("workSpaces"));
	}

	/**
	 * @return Application|Factory|View
	 */
	public function create()
	{
		return view('dashboard.work_space.create');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$valid = $this->checkValid($request);

		WorkSpace::create($valid);

		return redirect(route('work_space.index'))->with("msg", "فضای کاری موردنظر با موفقیت ثبت شد.");
	}

	/**
	 * @param WorkSpace $workSpace
	 * @return Application|Factory|View
	 */
	public function show(WorkSpace $workSpace)
	{
		return view('dashboard.work_space.edit',compact('workSpace'));
	}

	/**
	 * @param Request $request
	 * @param WorkSpace $workSpace
	 * @return Application|Factory|View
	 */
	public function edit(Request $request, WorkSpace $workSpace)
	{
		$this->validUser($workSpace);

		$fromDate = $request->input("from") ?? verta()->formatDate();
		$toDate = $request->input("to") ?? verta()->formatDate();

		$timeSheets = $workSpace->timeSheet()
			->whereDate("created_at", "<=", implode('-', Verta::getGregorian(...explode('-', $toDate))))
			->whereDate("created_at", ">=", implode('-', Verta::getGregorian(...explode('-', $fromDate))))
			->get();

		return view("dashboard.work_space.time", compact("timeSheets", "workSpace", "fromDate", "toDate"));
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

		return redirect(route('work_space.index'))->with("msg", "فضای کاری موردنظر با موفقیت ویرایش شد.");
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
