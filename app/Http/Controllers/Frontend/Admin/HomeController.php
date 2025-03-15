<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;
use App\Models\CMS;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;


class HomeController extends Controller
{
    public function index()
    {
        // site info and socials
        $siteInfo = SiteInfo::first();
        $data = json_decode($siteInfo->socials, true); // Decode as an associative array
        $socials = [];
        
        for ($i = 0; $i < count($data); $i += 2) {
            if (isset($data[$i]['name']) && isset($data[$i + 1]['link'])) {
                $socials[$data[$i]['name']] = $data[$i + 1]['link'];
            }
        }
        // home banner and why choose us
        $banner = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER->value)->first();
        $why_choose_us = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER_WHY_CHOOSE_US->value)->first();
        return view('welcome', compact('siteInfo', 'socials', 'banner', 'why_choose_us'));
    }
}
