<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use App\Services\SubCategoryServices;
use App\Services\CategoryServices;
use App\Helpers\PaginationHelper;

class SubcategoryController extends Controller
{
    protected $subcategoryServices;
    protected $categoryServices;

    // Inject Attribute Image service using constructor
    public function __construct(SubCategoryServices $subcategoryServices,CategoryServices $categoryServices){
        $this->subcategoryServices = $subcategoryServices;
        $this->categoryServices = $categoryServices;
    }

    // Index Create  Sub Category
    public function indexAddSubCategory(){
        $categories = $this->categoryServices->GetAllCategory();

        return view('Admin.subcategory-create', [
            'success' => $categories['success'] ?? false,
            'catMessage' => $categories['message'] ?? '',
            'allCategories' => $categories['data'] ?? [],
        ]);
    }

    // Create SubCategory
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                "subcategory_name"=>'required|string',
                "category_id"=>'required|exists:categories,category_id',
                "subcategory_image"=>'required|image|mimes:jpg,jpeg,png,webp|max:500|dimensions:width=100,height=100'
            ]);
            if ($validate->fails()) {
                # if Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # if Validation fails
                // File upload
                $file = $request->file('subcategory_image');
                $subcategory_slug = Str::slug($request->subcategory_name);
                $fileName = time() . '_' . $subcategory_slug . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('SubCategory'), $fileName);

                // Data to save
                $data = [
                    'subcategory_name'  => $request->subcategory_name,
                    'category_id'       => $request->category_id,
                    'subcategory_slug'  => $subcategory_slug,
                    'subcategory_image' => $fileName,
                ];
                $saveSubCategory = $this->subcategoryServices->addSubCategory($data);
                if ($saveSubCategory['success']) {
                    return redirect('/admin/subcategories')->with('success', $saveSubCategory['message']);
                }
                return redirect()->back()->with('error', $saveSubCategory['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Sub Category
    public function index(){
        try {
            //code...
            $subCategories=$this->subcategoryServices->getAllSubCategoriesWithCategory();
            $success = $subCategories['success'] ?? false;
            $message = $subCategories['message'] ?? '';
            $data    = $subCategories['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.subcategories', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Sub Category By Category
    public function edit($subcategory_id){
        try {
            //code...
            $subCategory = $this->subcategoryServices->getSubCategory($subcategory_id);
            $categories = $this->categoryServices->GetAllCategory();
            $success = $subCategory['success'] ?? false;
            $message = $subCategory['message'] ?? '';
            $data    = $subCategory['data'] ?? [];
            $allCategories = $categories['data'] ?? [];
            return view('Admin.subcategory-create', compact('success', 'message', 'data','allCategories'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Sub Category
    public function update(Request $request,$subcategory_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                "subcategory_name"=>'required|string',
                "category_id"=>'required|exists:categories,category_id',
                "subcategory_image"=>'image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=100,height=100'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                $subcategory_slug = \Str::slug($request->subcategory_name);
                $data = [
                    'subcategory_name'  => $request->subcategory_name,
                    'category_id'       => $request->category_id,
                    'subcategory_slug'  => $subcategory_slug,
                ];
                if ($request->hasFile('subcategory_image')) {
                    $file = $request->file('subcategory_image');
                    $fileName = time() . '_' . $subcategory_slug . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('SubCategory'), $fileName);
                    $data['subcategory_image'] = $fileName;
                }
                $updateSubCategory = $this->subcategoryServices->updateSubCategory($subcategory_id,$data);
                $message=$updateSubCategory['message'];
                if ($updateSubCategory['success']) {
                    return redirect('/admin/subcategories')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Sub Category
    public function delete($subcategory_id){
        try {
            //code...
            $response = $this->subcategoryServices->deleteSubCategory($subcategory_id);

            if (!empty($response['success']) && $response['success'] === true) {
                return redirect()->back()->with('success', $response['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $response['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
}
