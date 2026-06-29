<?php

namespace App\Services;

use App\Models\brand;
use Illuminate\Support\Facades\File;

class BrandServices {

    // Add New Brand
    public function addBrand($data){
        $addBrand=brand::create($data);
        if (!$addBrand) {
            # if Brand Not Added
            return [
                'success'=>false,
                'message'=>'Brand Not Added',
                'status'=>400
            ];
        } else {
            # if Brand is Added
            return [
                'success'=>true,
                'message'=>'Brand Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Brands
    public function getAllBrand(){
        $brands=brand::latest()->get();
        if (!$brands->count()>0) {
            # if Brand Not Exists
            return [
                'success'=>false,
                'message'=>'Brand Table is Empty',
                'status'=>400
            ];
        } else {
            # if Brand Exists
            return [
                'success'=>true,
                'data'=>$brands,
                'status'=>200
            ];
        }
    }

    // Get Brand
    public function getBrand($id){
        return $this->checkBrand($id);
    }

    // Update Brand
    public function updateBrand($id,$data){
        $Brand=$this->checkBrand($id);
        if (!$Brand['success']) {
            # if Brand Not Exists
            return $Brand;
        }
        $BrandData=$Brand['data'];
        // check Image Exists
        if (isset($data['brand_image'])) {
            # If Brand Image exists
            $image=$BrandData->brand_image;
            $this->deleteBrandImage($image);  # delete Brand Image 
        }
        $updateBrand=$BrandData->update($data);
        if (!$updateBrand) {
            # If Brand Updated
            return [
                'success'=>false,
                'message'=>'Brand Not Updated',
                'status'=>400
            ];
        } else {
            # If Brand Updated Successfully
            return [
                'success'=>true,
                'message'=>'Brand Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Brand
    public function deleteBrand($id){
        $Brand=$this->checkBrand($id);
        if (!$Brand['success']) {
            # if Brand Not Exists
            return $Brand;
        }
        $BrandData=$Brand['data'];
        $image=$BrandData->brand_image;
        $this->deleteBrandImage($image);  # delete Brand Image 
        $deleteBrand=$BrandData->delete();
        if (!$deleteBrand) {
            # If Brand Deleted
            return [
                'success'=>false,
                'message'=>'Brand Not Deleted',
                'status'=>400
            ];
        } else {
            # If Brand Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Brand Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Brand By Id
    public function checkBrand($id){
        $Brand=brand::find($id);
        if (!$Brand) {
            # If Brand Not Exists
            return [
                'success'=>false,
                'message'=>'Brand Not Exists',
                'status'=>400
            ];
        } else {
            # If Brand Exists
            return [
                'success'=>true,
                'data'=>$Brand,
                'status'=>200
            ];
        }
    }

    // Delete Brand Image By Brand Id
    public function deleteBrandImage($imageName){
        $path = public_path('Brand/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
    
}