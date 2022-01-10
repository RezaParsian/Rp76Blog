<?php

namespace Modules\CRM;

use App\Http\Helper\Menu;

require_once __DIR__ . "/vendor/autoload.php";

class CRM
{
    public function __construct()
    {
        Menu::instance()->add("CRM","crm","","fa fa-users",route("crm.index"),"*crm*");
    }
}
