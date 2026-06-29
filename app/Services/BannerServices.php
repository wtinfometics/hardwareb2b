<?php

namespace App\Services;

use App\Models\banner;
use Illuminate\Support\Facades\File;

class BannerServices {

    // Add New Banner
    public function addBanner($data){
        $addBanner=banner::create($data);
        if (!$addBanner) {
            # if Banner Not Added
            return [
                'success'=>false,
                'message'=>'Banner Not Added',
                'status'=>400
            ];
        } else {
            # if Banner is Added
            return [
                'success'=>true,
                'message'=>'Banner Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Banners
    public function getAllBanner(){
        $banners=banner::latest()->get();
        if (!$banners->count()>0) {
            # if Banner Not Exists
            return [
                'success'=>false,
                'message'=>'Banner Table is Empty',
                'status'=>400
            ];
        } else {
            # if Banner Exists
            return [
                'success'=>true,
                'data'=>$banners,
                'status'=>200
            ];
        }
    }

    // Get Banner
    public function getBanner($id){
        return $this->checkBanner($id);
    }

    // Update Banner
    public function updateBanner($id,$data){
        $banner=$this->checkBanner($id);
        if (!$banner['success']) {
            # if Banner Not Exists
            return $banner;
        }
        $bannerData=$banner['data'];
        // check Image Exists
        if (isset($data['banner_image'])) {
            # If Banner Image exists
            $image=$bannerData->banner_image;
            $this->deleteBannerImage($image);  # delete Banner Image 
        }
        $updateBanner=$bannerData->update($data);
        if (!$updateBanner) {
            # If Banner Updated
            return [
                'success'=>false,
                'message'=>'Banner Not Updated',
                'status'=>400
            ];
        } else {
            # If Banner Updated Successfully
            return [
                'success'=>true,
                'message'=>'Banner Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Banner
    public function deleteBanner($id){
        $banner=$this->checkBanner($id);
        if (!$banner['success']) {
            # if Banner Not Exists
            return $banner;
        }
        $bannerData=$banner['data'];
        $image=$bannerData->banner_image;
        $this->deleteBannerImage($image);  # delete Banner Image 
        $deleteBanner=$bannerData->delete();
        if (!$deleteBanner) {
            # If Banner Deleted
            return [
                'success'=>false,
                'message'=>'Banner Not Deleted',
                'status'=>400
            ];
        } else {
            # If Banner Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Banner Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Banner By Id
    public function checkBanner($id){
        $banner=banner::find($id);
        if (!$banner) {
            # If Banner Not Exists
            return [
                'success'=>false,
                'message'=>'Banner Not Exists',
                'status'=>400
            ];
        } else {
            # If Banner Exists
            return [
                'success'=>true,
                'data'=>$banner,
                'status'=>200
            ];
        }
    }
    
    // delete Banner Image By Banner Id
    public function deleteBannerImage($imageName){
        $path = public_path('Banners/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

       // get All Active Banners
    public function getAllActiveBanner(){
        $banners=banner::where('status',1)->latest()->get();
        if (!$banners->count()>0) {
            # if Banner Not Exists
            return [
                'success'=>false,
                'message'=>'No Active Banner Exists',
                'status'=>400
            ];
        } else {
            # if Banner Exists
            return [
                'success'=>true,
                'data'=>$banners,
                'status'=>200
            ];
        }
    }
}