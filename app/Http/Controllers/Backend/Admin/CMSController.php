<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;
use App\Models\CMS;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;

class CMSController extends Controller
{
    public function siteInfo()
    {
        $siteInfo = SiteInfo::first();
        return view('backend.admin.cms.site-info', compact('siteInfo'));
    }

    public function homeBanner()
    {
        $banner = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER->value)->first();
        return view('backend.admin.cms.home.banner', compact('banner'));
    }
}
