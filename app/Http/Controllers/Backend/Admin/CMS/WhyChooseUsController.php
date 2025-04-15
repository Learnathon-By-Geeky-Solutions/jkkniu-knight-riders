<?php

namespace App\Http\Controllers\Backend\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use App\Helpers\Helper;

class WhyChooseUsController extends Controller
{
    public function whyChooseUs(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = CMS::where('page', PageEnum::HOME)->where('section', SectionEnum::WHY_CHOOSE_US)->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function ($data) {
                        return $data->title;
                    })
                    ->addColumn('description', function ($data) {
                        return $data->description;
                    })
                    ->addColumn('status', function ($data) {
                        $backgroundColor = $data->status === "active" ? '#34b7f1' : '#ccc';
                        $sliderTranslateX = $data->status === "active" ? '26px' : '2px';
                        $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";
                        $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                        $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" data-area-id="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                        $status .= '<span style="' . $sliderStyles . '"></span>';
                        $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                        $status .= '</div>';
                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        return '
                            <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                <a href="' . route('cms.home.why-choose-us.edit', $data->id) . '" 
                                   title="Edit" 
                                   class="btn btn-sm" 
                                   style="background-color: #3498db; color: #fff; border-radius: 4px; padding: 5px 10px;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                   onclick="showDeleteConfirm(' . $data->id . ')" 
                                   title="Delete" 
                                   type="button"
                                   class="btn btn-sm" 
                                   style="background-color: #e74c3c; color: #fff; border-radius: 4px; padding: 5px 10px;">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>';
                    })                                 
                    ->rawColumns(['title', 'description', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.admin.cms.why-choose-us.index');  
        }
        catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function create()
    {
        return view("backend.admin.cms.why-choose-us.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::WHY_CHOOSE_US->value;

            $counting = CMS::where('page', $validatedData['page'])->where('section', $validatedData['section'])->count();
            if ($counting >= 3) {
                return redirect()->back()->with('t-error', 'Maximum 3 Item You Can Add');
            }

            if ($request->hasFile('image')) {
                $banner = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_BANNER->value)->first();
                if (isset($banner->image)) {
                    Helper::fileDelete($banner->image);
                }

                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'cms/home/banner', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            CMS::create($validatedData);
            return redirect()->route('cms.whyChooseUs')->with('t-success', 'Created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }


    public function show(string $id)
    {
        $choose = CMS::findOrFail($id);
        return view("backend.admin.cms.why-choose-us.update", compact("choose"));
    }

    public function edit(string $id)
    {
        $choose = CMS::findOrFail($id);
        return view("backend.admin.cms.why-choose-us.update", compact("choose"));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $icon = CMS::findOrFail($id);

            $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::WHY_CHOOSE_US->value;

            if ($request->hasFile('image')) {
                if (isset($icon->image)) {
                    Helper::fileDelete($icon->image);
                }

                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'cms/home/why-choose-us', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            $icon->update($validatedData);
            return redirect()->route('cms.whyChooseUs')->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        try {
            $data = CMS::findOrFail($id);

            if ($data->image && file_exists(public_path($data->image))) {
                deleteImage(public_path($data->image));
            }

            $data->delete();

            return response()->json([
                't-success' => true,
                'message' => 'Deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-success' => false,
                'message' => 'Failed to delete.',
            ]);
        }
    }

    public function status(int $id): JsonResponse
    {
        $data = CMS::findOrFail($id);
        if (!$data) {
            return response()->json([
                "success" => false,
                "message" => "Item not found.",
                "data" => $data,
            ]);
        }
        $data->status = $data->status === 'active' ? 'inactive' : 'active';
        $data->save();
        return response()->json([
            't-success' => true,
            'message' => 'Item status changed successfully.',
            'data'    => $data,
        ]);
    }
}
