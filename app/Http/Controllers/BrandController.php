<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\BrandServices;
use App\Helpers\PaginationHelper;

class BrandController extends Controller
{

    protected $brandServices;

    // Inject Attribute Image service using constructor
    public function __construct(BrandServices $brandServices){
        $this->brandServices = $brandServices;
    }

    // index add Brand 
    public function indexAddBrand(){
        return view('Admin.brand-create');
    }

    // Create Brand 
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                "brand_name"=>'required|string',
                "brand_image"=>'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=100,height=100'
            ]);
            if ($validate->fails()) {
                # If Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation Fails
                $file = $request->file('brand_image');
                $fileName = time() . '_' . $request->brand_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Brand'), $fileName);

                // Data to save
                $data = [
                    'brand_name'  => $request->brand_name,
                    'brand_image' => $fileName,
                ];
                $saveBrand = $this->brandServices->addBrand($data);
                if ($saveBrand['success']) {
                    return redirect('/admin/brands')->with('success', $saveBrand['message']);
                }
                return redirect()->back()->with('error', $saveBrand['message'])->withInput();
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Brands
    public function index(){
        try {
            //code...
            $brands=$this->brandServices->getAllBrand();
            $success = $brands['success'] ?? false;
            $message = $brands['message'] ?? '';
            $data    = $brands['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.brands', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // view Brand
    public function edit($brand_id){
        try {
            //code...
            $brand = $this->brandServices->getBrand($brand_id);
            $success = $brand['success'] ?? false;
            $message = $brand['message'] ?? '';
            $data    = $brand['data'] ?? [];
            return view('Admin.brand-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Brand
    public function update(Request $request,$brand_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                "brand_name"=>'required|string',
                "brand_image"=>'image|mimes:jpg,jpeg,png,webp|max:500|dimensions:width=100,height=100'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                $data = [
                    'brand_name'  => $request->brand_name,
                ];
                if ($request->hasFile('brand_image')) {
                    $file = $request->file('brand_image');
                    $fileName = time() . '_' . $request->brand_name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Brand'), $fileName);
                    $data['brand_image'] = $fileName;
                }
                $updateBrand = $this->brandServices->updateBrand($brand_id,$data);
                $message=$updateBrand['message'];
                if ($updateBrand['success']) {
                    return redirect('/admin/brands')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Brand
    public function delete($brand_id){
        try {
            //code...
            $deleteBrand = $this->brandServices->deleteBrand($brand_id);

            if (!empty($deleteBrand['success']) && $deleteBrand['success'] === true) {
                return redirect()->back()->with('success', $deleteBrand['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteBrand['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
