<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;

class HomeController extends Controller
{
    public function index()
    {
        $siteInfo = SiteInfo::first();
        $data = json_decode($siteInfo->socials, true); // Decode as an associative array
        $socials = [];
        
        for ($i = 0; $i < count($data); $i += 2) {
            if (isset($data[$i]['name']) && isset($data[$i + 1]['link'])) {
                $socials[$data[$i]['name']] = $data[$i + 1]['link'];
            }
        }

        return view('welcome', compact('siteInfo', 'socials'));
    }
}
