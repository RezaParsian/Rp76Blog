<?php

namespace App\Http\Controllers\Dashboard\Timesheet;

use App\Http\Controllers\Controller;
use App\Models\TimeSheet;
use App\Models\WorkSpace;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TimeSheetController extends Controller
{
	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$valid = $request->validate([
			TimeSheet::WORK_SPACE_ID => ['required', 'numeric'],
			TimeSheet::WORK_TIME => ['required'],
			TimeSheet::DESCRIPTION => ['nullable']
		]);

		list($workPerMin, $hourToMinute) = $this->getWorkSpacePrice($valid);

		$valid[TimeSheet::WORK_TIME] = $hourToMinute;
		$valid[TimeSheet::USER_ID] = Auth::id();
		$valid[TimeSheet::PRICE] = $workPerMin * $hourToMinute;

		TimeSheet::create($valid);

		return back()->with("msg", "ساعت کاری با موفقیت اضافه گردید.<br>درآمد شما : " . $valid[TimeSheet::PRICE]);
	}


	/**
	 * @param TimeSheet $timeSheet
	 * @return RedirectResponse
	 */
	public function destroy(TimeSheet $timeSheet): RedirectResponse
	{
		if ($timeSheet->user_id != Auth::id())
			abort(404);

		$timeSheet->delete();
		return back()->with("msg", "ساعت کاری موردنظر با موفقیت حذف شد.");
	}

	/**
	 * @param array $valid
	 * @return array
	 */
	private function getWorkSpacePrice(array $valid): array
	{
		$workSpace = WorkSpace::find($valid[TimeSheet::WORK_SPACE_ID]);
		$workPerMin = $workSpace->price / 60;
		$hourToMinute = (explode(":", $valid[TimeSheet::WORK_TIME])[0] * 60) + (explode(":", $valid[TimeSheet::WORK_TIME])[1]);
		return array($workPerMin, $hourToMinute);
	}

	/**
	 * @param Request $request
	 * @param WorkSpace $workSpace
	 * @return StreamedResponse
	 */
	public function exportAsCsv(Request $request, WorkSpace $workSpace): StreamedResponse
	{
		$exportData = 'ردیف, زمان (دقیقه    ), توضیحات ,مبلغ (ریال), تاریخ ثبت' . PHP_EOL;

		$fromDate = $request->input("from") ?? verta()->formatDate();
		$toDate = $request->input("to") ?? verta()->formatDate();

		$timeSheets = $workSpace->timeSheet()
			->whereDate("created_at", "<=", implode('-', Verta::getGregorian(...explode('-', $toDate))))
			->whereDate("created_at", ">=", implode('-', Verta::getGregorian(...explode('-', $fromDate))))
			->get();


		$headers = [
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . verta()->formatDatetime() . ".csv" . '"',
		];

		$callback = function () use ($timeSheets) {
			$file = fopen('php://output', 'w');

			fputcsv($file, ['ردیف', 'زمان (دقیقه)', 'توضیحات', 'مبلغ (﷼)', 'تاریخ ثبت']);

			$timeSheets->map(function (TimeSheet $timeSheet, $key) use ($file) {
				fputcsv($file, [$key + 1, $timeSheet->work_time, $timeSheet->description, $timeSheet->price, $timeSheet->created_at_p]);
			});


			foreach (range(0,2) as $item)
				fputcsv($file, []);

			fputcsv($file, ["زمان کلی : " . str_replace(",", "،", number_format($timeSheets->sum("work_time"))) . " دقیقه"]);

			foreach (range(0,1) as $item)
				fputcsv($file, []);

			fputcsv($file, ["مبلغ کلی : " . str_replace(",", "،", number_format($timeSheets->sum("price"))) . " ﷼"]);

			fclose($file);
		};

		return Response::streamDownload($callback, verta()->formatDatetime() . ".csv", $headers);
	}
}
