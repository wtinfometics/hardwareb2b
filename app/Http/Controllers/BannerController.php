<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\BannerServices;
use App\Helpers\PaginationHelper;

class BannerController extends Controller
{

    protected $bannerService;

    // Inject Attribute Image service using constructor
    public function __construct(BannerServices $bannerService){
        $this->bannerService = $bannerService;
    }

    // index add Brand 
    public function indexAddBanner(){
        return view('Admin.banner-create');
    }

    // Create Banner
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'banner_name'=>'required|string',
                'banner_header'=>'required|string',
                'featured_message'=>'string',
                'link'=>'url',
                'button_text'=>'string',
                "banner_image"=>'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=577,height=432',
                'status'=>'boolean'
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                // File upload
                $file = $request->file('banner_image');
                $fileName = time() . '_' . $request->banner_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Banners'), $fileName);

                $data = [
                    'banner_name'   =>$request->banner_name ,
                    'banner_header' =>$request->banner_header,
                    'featured_message'=>$request->featured_message ,
                    'link'          =>$request->link ?? '',
                    'button_text'   =>$request->button_text ?? '',
                    'banner_image'  =>$fileName ,
                    'status'        =>$request->status ?? '',
                ];
                $saveBanner = $this->bannerService->addBanner($data);
                if ($saveBanner['success']) {
                    return redirect('/admin/banners')->with('success', $saveBanner['message']);
                }
                return redirect()->back()->with('error', $saveBanner['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }


    // View All Banner
    public function index(){
        try {
            //code...
            $banners=$this->bannerService->getAllBanner();
            $success = $banners['success'] ?? false;
            $message = $banners['message'] ?? '';
            $data    = $banners['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.banners', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Banner
    public function edit($banner_id){
        try {
            //code...
            $banner = $this->bannerService->getBanner($banner_id);
            $success = $banner['success'] ?? false;
            $message = $banner['message'] ?? '';
            $data    = $banner['data'] ?? [];
            return view('Admin.banner-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Banner
    public function update(Request $request,$banner_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'banner_name'=>'required|string',
                'banner_header'=>'required|string',
                'featured_message'=>'string',
                'link'=>'url',
                'button_text'=>'string',
                "banner_image"=>'image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=577,height=432',
                'status'=>'boolean'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                $data = [
                    'banner_name'   =>$request->banner_name ,
                    'banner_header' =>$request->banner_header,
                    'featured_message'=>$request->featured_message ,
                    'link'          =>$request->link ?? '',
                    'button_text'   =>$request->button_text ?? '',
                    'status'        =>$request->status ?? '',
                ];
                if ($request->hasFile('banner_image')) {
                    $file = $request->file('banner_image');
                    $fileName = time() . '_' . $request->banner_name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Banners'), $fileName);
                    $data['banner_image'] = $fileName;
                }
                $updateBanner = $this->bannerService->updateBanner($banner_id,$data);
                $message=$updateBanner['message'];
                if ($updateBanner['success']) {
                    return redirect('/admin/banners')->with('success',$message);
                } else {
                    return redirect()->back()->with('error', $th->getMessage())->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Banner
    public function delete($banner_id){
        try {
            //code...
            $deleteBanner = $this->bannerService->deleteBanner($banner_id);

            if (!empty($deleteBanner['success']) && $deleteBanner['success'] === true) {
                return redirect()->back()->with('success', $deleteBanner['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteBanner['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
