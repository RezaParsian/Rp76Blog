<?php

namespace Modules\TimeSheet\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\TimeSheet\Models\TimeSheet;
use Modules\TimeSheet\Models\WorkSpace;
use Ramsey\Uuid\Type\Time;

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

        return back()->with("mgs", "ساعت کاری با موفقیت اضاف گردید.<br>درآمد شما : " . $valid[TimeSheet::PRICE]);
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
}
