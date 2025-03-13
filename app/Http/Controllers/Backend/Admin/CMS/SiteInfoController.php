<?php

namespace App\Http\Controllers\Backend\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;

class SiteInfoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'copyright_text' => 'required',
            'socials' => 'required',
        ]);

        $siteInfo = SiteInfo::first();
        $siteInfo->site_name = $request->site_name;
        $siteInfo->email = $request->email;
        $siteInfo->phone = $request->phone;
        $siteInfo->address = $request->address;
        $siteInfo->copyright_text = $request->copyright_text;
        $siteInfo->socials = json_encode($request->socials);
        $siteInfo->save();

        return redirect()->back()->with('success', 'Site Info updated successfully');
    }
}
