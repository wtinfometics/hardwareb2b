<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use App\Services\CategoryServices;
use App\Helpers\PaginationHelper;

class CategoryController extends Controller
{
    protected $categoryServices;

    // Inject Attribute Image service using constructor
    public function __construct(CategoryServices $categoryServices){
        $this->categoryServices = $categoryServices;
    }

    // Index Create Category 
    public function createCategory(){
        return view('Admin.category-create');
    }

    // Create Category
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(), [
                'category_name'  => 'required|string|max:255',
                'category_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:500|dimensions:width=100,height=100',
            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            // File upload
            $file = $request->file('category_image');
            $category_slug = Str::slug($request->category_name);
            $fileName = time() . '_' . $category_slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Category'), $fileName);

            // Data to save
            $data = [
                'category_name'  => $request->category_name,
                'category_slug'  => $category_slug,
                'category_image' => $fileName,
            ];

            $saveCategory = $this->categoryServices->addCategory($data);

            if ($saveCategory['success']) {
                return redirect('/admin/categories')->with('success', $saveCategory['message']);
            }

            return redirect()->back()->with('error', $saveCategory['message'])->withInput();

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Categories
    public function index(){
        try {
            //code...
            $categories=$this->categoryServices->GetAllCategory();
            $success = $categories['success'] ?? false;
            $message = $categories['message'] ?? '';
            $data    = $categories['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.categories', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Something went wrong, please try again!');
        }
    }

    // View Category
    public function edit($category_id){
        try {
            $category = $this->categoryServices->getCategory($category_id);
            $success = $category['success'] ?? false;
            $message = $category['message'] ?? '';
            $data    = $category['data'] ?? [];
            return view('Admin.category-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }

    // Update Category
    public function update(Request $request,$category_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'category_name'=>'required|string',
                'category_image' => 'image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=100,height=100',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                $category_slug = \Str::slug($request->category_name);
                $data = [
                    'category_name' => $request->category_name,
                    'category_slug'=>$category_slug,
                ];
                if ($request->hasFile('category_image')) {
                    $file = $request->file('category_image');
                    $fileName = time() . '_' . $category_slug . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Category'), $fileName);
                    $data['category_image'] = $fileName;
                }
                $saveCategory = $this->categoryServices->updateCategory($category_id,$data);
                $message=$saveCategory['message'];
                if ($saveCategory['success']) {
                    return redirect('/admin/categories')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Category
    public function delete($category_id){
        try {
             $response = $this->categoryServices->deleteCategory($category_id);

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
