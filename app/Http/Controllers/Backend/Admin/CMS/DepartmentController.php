<?php

namespace App\Http\Controllers\Backend\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Helpers\Helper;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('backend.admin.departments.index');
    }

    public function update(Request $request)
    {
        $validatedData = request()->validate([
            'title'         => 'nullable|string|max:255',
            'sub_title'   => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        try {
            $validatedData['page'] = PageEnum::DEPARTMENT->value;
            $validatedData['section'] = SectionEnum::DEPARTMENTS->value;
            if ($request->hasFile('image')) {
                $banner = CMS::where('page', PageEnum::DEPARTMENT->value)->where('section', SectionEnum::DEPARTMENTS->value)->first();
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'cms/department', time() . '_' . $request->file('image')->getClientOriginalName());
            }
            CMS::where('page', PageEnum::DEPARTMENT->value)->where('section', SectionEnum::DEPARTMENTS->value)->update($validatedData);
            return response()->json(['status' => true, 'message' => 'Department Banner Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
