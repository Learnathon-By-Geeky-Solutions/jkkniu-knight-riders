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
    /**
     * Display Why Choose Us items in DataTable
     */
    public function whyChooseUs(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = CMS::where('page', PageEnum::HOME)
                    ->where('section', SectionEnum::WHY_CHOOSE_US)
                    ->latest()
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', fn($data) => $data->title)
                    ->addColumn('description', fn($data) => $data->description)
                    ->addColumn('status', function ($data) {
                        $isActive = $data->status === "active";
                        $backgroundColor = $isActive ? '#34b7f1' : '#ccc';
                        $sliderTranslateX = $isActive ? '26px' : '2px';
                        
                        return <<<HTML
                        <div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: {$backgroundColor}; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">
                            <input onclick="showStatusChangeAlert({$data->id})" type="checkbox" class="form-check-input" id="customSwitch{$data->id}" data-area-id="{$data->id}" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">
                            <span style="position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX({$sliderTranslateX});"></span>
                            <label for="customSwitch{$data->id}" class="form-check-label" style="margin-left: 10px;"></label>
                        </div>
                        HTML;
                    })
                    ->addColumn('action', function ($data) {
                        $editUrl = route('cms.home.why-choose-us.edit', $data->id);
                        
                        return <<<HTML
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="{$editUrl}" title="Edit" class="btn btn-sm" style="background-color: #3498db; color: #fff; border-radius: 4px; padding: 5px 10px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm" style="background-color: #e74c3c; color: #fff; border-radius: 4px; padding: 5px 10px;" onclick="showDeleteConfirm({$data->id})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        HTML;
                    })
                    ->rawColumns(['title', 'description', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.admin.cms.why-choose-us.index');
        } catch (\Throwable $th) {
            return $this->jsonError($th->getMessage());
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view("backend.admin.cms.why-choose-us.create");
    }

    /**
     * Store new Why Choose Us item
     */
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

            $count = CMS::where('page', $validatedData['page'])
                ->where('section', $validatedData['section'])
                ->count();
                
            if ($count >= 3) {
                return redirect()->back()
                    ->with('toast_error', 'Maximum 3 items allowed')
                    ->withInput();
            }

            if ($request->hasFile('image')) {
                $validatedData['image'] = Helper::fileUpload(
                    $request->file('image'), 
                    'cms/home/why-choose-us', 
                    time().'_'.$request->file('image')->getClientOriginalName()
                );
            }

            CMS::create($validatedData);
            
            return redirect()->route('cms.whyChooseUs')
                ->with('toast_success', 'Created successfully');

        } catch (Exception $e) {
            return redirect()->back()
                ->with('toast_error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show single item
     */
    public function show(string $id)
    {
        $choose = CMS::findOrFail($id);
        return view("backend.admin.cms.why-choose-us.update", compact("choose"));
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $choose = CMS::findOrFail($id);
        return view("backend.admin.cms.why-choose-us.update", compact("choose"));
    }

    /**
     * Update Why Choose Us item
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $item = CMS::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($item->image) {
                    Helper::fileDelete($item->image);
                }
                $validatedData['image'] = Helper::fileUpload(
                    $request->file('image'),
                    'cms/home/why-choose-us',
                    time().'_'.$request->file('image')->getClientOriginalName()
                );
            }

            $item->update($validatedData);
            
            return redirect()->route('cms.whyChooseUs')
                ->with('toast_success', 'Updated successfully');

        } catch (Exception $e) {
            return redirect()->back()
                ->with('toast_error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete Why Choose Us item
     */
    public function destroy($id)
    {
        try {
            $data = CMS::findOrFail($id);

            if ($data->image && file_exists(public_path($data->image))) {
                @unlink(public_path($data->image));
            }
            
            $data->delete();
            
            return $this->jsonSuccess('Deleted successfully');
            
        } catch (\Exception $e) {
            return $this->jsonError('Failed to delete: '.$e->getMessage());
        }
    }

    /**
     * Toggle item status
     */
    public function status(int $id): JsonResponse
    {
        try {
            $data = CMS::findOrFail($id);
            $data->status = $data->status === 'active' ? 'inactive' : 'active';
            $data->save();
            
            return $this->jsonSuccess('Status changed successfully', $data);
            
        } catch (\Exception $e) {
            return $this->jsonError('Item not found: '.$e->getMessage());
        }
    }

    /**
     * Helper for JSON success responses
     */
    private function jsonSuccess(string $message, $data = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Helper for JSON error responses
     */
    private function jsonError(string $message, int $status = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}