<?php

namespace Modules\TimeSheet\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Modules\TimeSheet\Models\TimeSheet;
use Modules\TimeSheet\Models\WorkSpace;
use Ramsey\Uuid\Type\Time;
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
        ]);

        list($workPerMin, $hourToMinute) = $this->getWorkSpacePrice($valid);

        $valid[TimeSheet::WORK_TIME] = $workPerMin;
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
        $exportData = 'ID, Time, Price, Date' . PHP_EOL;

        $timeSheets = $workSpace->timeSheet()
            ->whereDate("created_at", ">=", Carbon::make(Carbon::now()->year . "-" . Carbon::now()->month . "-1"))
            ->whereDate("created_at", "<=", Carbon::make(Carbon::now()->year . "-" . Carbon::now()->month . "-31"))->get();

        $timeSheets->map(function (TimeSheet $timeSheet, $key) use (&$exportData) {
            $exportData .= ($key + 1) . ",{$timeSheet->work_time},{$timeSheet->price},{$timeSheet->created_at_p}" . PHP_EOL;
        });

        $exportData .= str_repeat(PHP_EOL, 5) . "Total Time : ".str_replace(",","،",number_format($timeSheets->sum("work_time")))." دقیقه";
        $exportData .= str_repeat(PHP_EOL, 2) . "Total Price : ".str_replace(",","،",number_format($timeSheets->sum("price")))." ﷼";

        return Response::streamDownload(fn()=>print ($exportData),verta()->formatDatetime().".csv");
    }
}
