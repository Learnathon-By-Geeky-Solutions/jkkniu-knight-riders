<?php

namespace App\Http\Controllers\Backend\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Models\CMS;
use Exception;

class HomeBannerWhyChooseUsController extends Controller
{
    public function index()
    {
        $why_choose_us = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER_WHY_CHOOSE_US->value)->first();
        return view('backend.admin.cms.home.why-choose-us', compact('why_choose_us'));
    }

    public function update(Request $request)
    {
        $validatedData = request()->validate([
            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'btn_text'         => 'nullable|string|max:255',
        ]);
        
        try {
            $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::HOME_BANNER_WHY_CHOOSE_US->value;

            $pageSection = CMS::where('page', $validatedData['page'])->where('section', $validatedData['section']);

            if ($pageSection->exists()) {
                $pageSection->update($validatedData);
            } else {
                CMS::create($validatedData);
            }

            return redirect()->route('cms.home.banner.why-choose-us.index')->with('success', 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
