<?php
namespace App\Helpers;

use App\Models\Menu;
use App\Models\Profile;

class AnyHelpers
{
    public static function AppInfo() {
        return Profile::first();
    }

    public static function getMenus() {
        return Menu::where('status', 'active')->get();
    }
}
