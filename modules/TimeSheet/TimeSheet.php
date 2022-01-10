<?php

namespace Modules\TimeSheet;

use App\Http\Helper\Menu;

require_once __DIR__ . "/vendor/autoload.php";

class TimeSheet
{
    public function __construct()
    {
        Menu::instance()->add("فضای کاری","workspace","","fa fa-briefcase",route("work_space.index"),"*work_space*");
    }
}
