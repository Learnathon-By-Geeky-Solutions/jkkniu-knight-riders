<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;

class CMSController extends Controller
{
    public function siteInfo()
    {
        $siteInfo = SiteInfo::first();
        return view('backend.admin.cms.site-info', compact('siteInfo'));
    }

    public function homeBanner()
    {
        return view('backend.admin.cms.home.banner');
    }
}
