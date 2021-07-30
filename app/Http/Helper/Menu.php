<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;

class Menu
{
    public array $menus = [];

    public function __construct()
    {
        $this->add("داشبورد", "dashboard", "", "fa fa-dashboard", route("dashboard"),"dashboard");
        $this->add("CRM", "crm", "", "fa fa-thumb-tack");
        $this->add("مقالات", "crm.article", "crm", "fa fa-thumb-tack", route("article.index"),"dashboard/article*");
        $this->add("تنظیمات", "setting", "", "fa fa-cogs");
        $this->add("پروفایل", "setting.profile", "setting", "fa fa-user");
    }

    public function add($title, $slug, $parent = "", $icon = "", $link = "#Rp",$active="", $permission = "")
    {
        $key = $parent != "" ? $parent : $slug;
        if (!isset($this->menus[$key]))
            $this->menus[$key] = [];
        array_push($this->menus[$key], (object)[
            "title" => $title,
            "slug" => $slug,
            "parent" => $parent,
            "icon" => $icon,
            "link" => $link,
            "active" => $active,
            "permission" => $permission
        ]);
    }

    public function render()
    {
        collect($this->menus)->each(function ($menu) use (&$result) {
            $result .= $this->generateMenu($menu);
        });
        return $result;
    }

    private function generateMenu($menu): string
    {
        $arrow=count($menu)>=2 ? "<i class='right fa fa-angle-left'>" : "";

        $result = '<li class="nav-item has-treeview">';
        $result .= "<a href='{$menu[0]->link}' id='{$menu[0]->slug}' class='nav-link'>";
        $result .= "<i class='nav-icon {$menu[0]->icon}'></i>";
        $result .= "<p class='text-white'>{$menu[0]->title}{$arrow}</i></p></a>";

        $menu = array_slice($menu, 1, 1);

        if ($menu) {
            $result.="<ul class='nav nav-treeview'>";
            collect($menu)->each(function ($item) use (&$result) {
                $active= Request()->is("$item->active") ? " active" : "";
                $result .= "<li class='nav-item'>";
                $result .= "<a href='{$item->link}' data-parent='{$item->parent}' class='nav-link {$active}'>";
                $result .= "<i class='fa fa-book nav-icon'></i>";
                $result .= "<p>{$item->title}</p></a></li>";
            });
            $result.="</ul>";
        }

        $result .= "</li>";
        return $result;
    }
}
