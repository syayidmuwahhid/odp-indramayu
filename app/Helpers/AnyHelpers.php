<?php
namespace App\Helpers;

use App\Models\Profile;

class AnyHelpers
{
    static function AppInfo() {
        return Profile::first();
    }
}
