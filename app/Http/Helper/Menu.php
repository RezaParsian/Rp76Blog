<?php

namespace App\Http\Helper;

use App\View\Components\Svg\Backward;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class Menu
{
    private static self $instance;
    public array $menus = [];

    /**
     * @return Menu
     */
    public static function instance(): Menu
    {
        return self::$instance ?? self::$instance = new self();
    }

    public function __construct()
    {
        $this->add("داشبورد", "dashboard", "", "fa fa-dashboard", route("dashboard"), "dashboard");
        $this->add("مقالات", "article", '', "fa fa-thumb-tack", route("article.index"), "dashboard/article*","posts");
        $this->add("دسته بندی ها", "category", '', "fa fa-sitemap", route("category.index"), "dashboard/category*","posts");
        $this->add("تگ ها", "tag", '', "fa fa-tags", route("tag.index"), "dashboard/tag*","posts");
		$this->add("کاربران","crm","","fa fa-users",route("crm.index"),"*crm*");

//        $this->add("تنظیمات", "setting", "", "fa fa-cogs");
//        $this->add("پروفایل", "setting.profile", "setting", "fa fa-user");
    }

    public function add($title, $slug, $parent = "", $icon = "", $link = "#Rp", $active = "", $permission = "")
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
        $arrow = count($menu) >= 2 ? (new Backward())->render() : "";

        $active = Request()->is($menu[0]->active) ? " active" : "";
        $result = '<li class="hover:bg-rp-400 rounded p-2">';
        $result .= "<a href='{$menu[0]->link}' id='{$menu[0]->slug}' class='nav-link {$active}'>";
        $result .= "<i class='nav-icon {$menu[0]->icon}'></i>";
        $result .= "<p>{$menu[0]->title}{$arrow}</i></p></a>";

        $menu = array_slice($menu, 1);

        if ($menu) {
            $result .= "<ul class='nav nav-treeview'>";
            collect($menu)->each(function ($item) use (&$result) {
                $active = Request()->is("$item->active") ? " active" : "";
                $result .= "<li class='nav-item'>";
                $result .= "<a href='{$item->link}' data-parent='{$item->parent}' class='nav-link {$active}'>";
                $result .= "<i class='fa {$item->icon} nav-icon'></i>";
                $result .= "<p>{$item->title}</p></a></li>";
            });
            $result .= "</ul>";
        }

        $result .= "</li>";
        return $result;
    }
}
