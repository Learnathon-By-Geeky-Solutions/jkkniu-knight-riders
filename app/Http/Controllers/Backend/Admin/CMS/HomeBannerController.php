<?php

namespace App\Http\Controllers\Backend\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Helpers\Helper;
use App\Models\CMS;
use Exception;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banner = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER->value)->first();
        return view('backend.admin.cms.home.banner', compact('banner'));
    }

    public function update(Request $request)
    {
        $validatedData = request()->validate([
            'title'         => 'nullable|string|max:255',
            'sub_title'   => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        try {
            $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::HOME_BANNER->value;
            if ($request->hasFile('image')) {
                $banner = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER->value)->first();
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'cms/home/banner', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            $pageSection = CMS::where('page', $validatedData['page'])->where('section', $validatedData['section']);

            if ($pageSection->exists()) {
                $pageSection->update($validatedData);
            } else {
                CMS::create($validatedData);
            }

            return redirect()->route('cms.home.banner.index')->with('success', 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
