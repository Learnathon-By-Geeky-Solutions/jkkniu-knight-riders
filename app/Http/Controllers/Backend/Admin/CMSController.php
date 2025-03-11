<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function siteInfo()
    {
        return view('backend.admin.cms.site-info');
    }

    public function homeBanner()
    {
        return view('backend.admin.cms.home.banner');
    }
}
