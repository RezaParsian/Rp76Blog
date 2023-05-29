<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CrmController extends Controller
{
	public function __construct()
	{
		$this->middleware("role:crm")->only("index");
		$this->middleware("role:crm.create")->only(["create", "store"]);
		$this->middleware("role:crm.edit")->only(["edit", "show"]);
		$this->middleware("role:crm.delete")->only(["destroy"]);
	}

	/**
	 * @return Application|Factory|View
	 */
	public function index()
	{
		$users = User::orderBy("id", "DESC")->paginate();
		return view("dashboard.users.index", compact('users'));
	}

	public function create()
	{
		abort(404);
	}

	/**
	 * @param Request $request
	 */
	public function store(Request $request)
	{
		abort(404);
	}

	/**
	 * @param $id
	 */
	public function show($id)
	{
		abort(404);
	}

	/**
	 * @param User $crm
	 * @return Application|Factory|View
	 */
	public function edit(User $crm)
	{
		return view('dashboard.users.edit', ['user' => $crm]);
	}

	/**
	 * @param Request $request
	 * @param User $crm
	 * @return Application|RedirectResponse|Redirector
	 */
	public function update(Request $request, User $crm)
	{
		$data = $request->validate([
			User::NAME => ['required', "string"],
			User::EMAIL => ['required', "unique:users,email," . $crm->id],
			User::PASSWORD => ['nullable'],
			User::ROLE_ID => ['required', 'numeric', 'exists:roles,id']
		]);

		if (!empty($data[User::PASSWORD]))
			$data[User::PASSWORD] = bcrypt($data[User::PASSWORD]);
		else
			unset($data[User::PASSWORD]);

		$crm->update($data);

		return redirect(route('crm.index'))->with("msg", "کاربر موردنظر با موفقیت ویرایش شد.");
	}

	/**
	 * @param $id
	 */
	public function destroy($id)
	{
		abort(403, "No one can delete any user");
	}

	public function switchUser(Request $request)
	{
		if (Session::has("user_id")) {
			Auth::loginUsingId(Session::get('user_id'));
			Session::remove("user_id");
		} else {
			Session::put("user_id", Auth::id());
			Auth::loginUsingId($request->input("user_id"));
		}

		return redirect(route('dashboard'))->with("msg", "حساب کاربری با موفقیت تعویض شد.");
	}
}
