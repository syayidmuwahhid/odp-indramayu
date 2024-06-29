<?php
namespace App\Helpers;

use App\Models\Profile;

class Anyhelpers
{
    static function AppInfo() {
        return Profile::first();
    }
}
