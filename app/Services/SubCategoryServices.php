<?php

namespace App\Services;

use App\Models\subcategory;
use Illuminate\Support\Facades\File;

class SubCategoryServices {
    
    // Add Sub Category 
    public function addSubCategory($data){
        $addSubCategory=subcategory::create($data);
        if (!$addSubCategory) {
            # if SubCategory Not Added
            return [
                'success'=>false,
                'message'=>'SubCategory Not Added',
                'status'=>400
            ];
        } else {
            # if SubCategory is Added
            return [
                'success'=>true,
                'message'=>'SubCategory Added Successfully',
                'status'=>200
            ];
        }
    }

    // Get All Sub Categories
    public function getAllSubCategory(){
        $subCategories=subcategory::latest()->get();
        if (!$subCategories->count()>0) {
            # if SubCategory Not Exists
            return [
                'success'=>false,
                'message'=>'SubCategory Table is Empty',
                'status'=>400
            ];
        } else {
            # if SubCategory Exists
            return [
                'success'=>true,
                'data'=>$subCategories,
                'status'=>200
            ];
        }
    }

    // Get All Sub Categories with Category Details
    public function getAllSubCategoriesWithCategory(){
        $subCategories=subcategory::with('category')->get();
        if (!$subCategories->count()>0) {
            # if SubCategory Not Exists
            return [
                'success'=>false,
                'message'=>'SubCategory Table is Empty',
                'status'=>400
            ];
        } else {
            # if SubCategory Exists
            return [
                'success'=>true,
                'data'=>$subCategories,
                'status'=>200
            ];
        }
    }
    
    // Get Sub Category
    public function getSubCategory($id){
        return $this->checkSubCategory($id);
    }
    
    // Update Sub Category
    public function updateSubCategory($id,$data){
        $subCategory=$this->checkSubCategory($id);
        if (!$subCategory['success']) {
            # if SubCategory Not Exists
            return $subCategory;
        }
        $subCategoryData=$subCategory['data'];
        // If Data Contain Sub Category Image
        if (isset($data['subcategory_image'])) {
            # code...
            $subCategoryImage=$subCategoryData->subcategory_image;
            $this->deleteSubcategoryImage($subCategoryImage);  # Delete Su Category Image
        }
        $updateSubCategory=$subCategoryData->update($data);
        if (!$updateSubCategory) {
            # If SubCategory Updated
            return [
                'success'=>false,
                'message'=>'SubCategory Not Updated',
                'status'=>400
            ];
        } else {
            # If SubCategory Updated Successfully
            return [
                'success'=>true,
                'message'=>'SubCategory Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Sub Category
    public function deleteSubCategory($id){
        $subCategory=$this->checkSubCategory($id);
        if (!$subCategory['success']) {
            # if SubCategory Not Exists
            return $subCategory;
        }
        $subCategoryData=$subCategory['data'];
        $subCategoryImage=$subCategoryData->subcategory_image;
        $this->deleteSubcategoryImage($subCategoryImage);  # Delete Su Category Image
        $deleteSubCategory=$subCategoryData->delete();
        if (!$deleteSubCategory) {
            # If SubCategory Deleted
            return [
                'success'=>false,
                'message'=>'SubCategory Not Deleted',
                'status'=>400
            ];
        } else {
            # If SubCategory Deleted Successfully
            return [
                'success'=>true,
                'message'=>'SubCategory Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Sub Category
    public function checkSubCategory($id){
        $subCategory=subcategory::find($id);
        if (!$subCategory) {
            # If SubCategory Not Exists
            return [
                'success'=>false,
                'message'=>'SubCategory Not Exists',
                'status'=>400
            ];
        } else {
            # If SubCategory Exists
            return [
                'success'=>true,
                'data'=>$subCategory,
                'status'=>200
            ];
        }
    }

    // Get All Sub Category By Category (category_id)
    public function getSubCategoryByCategory($category_id){
        $subCategory=subcategory::where('category_id',$category_id)->get();
        if (!$subCategory->count()>0) {
            # If SubCategory Not Exists
            return [
                'success'=>false,
                'message'=>'SubCategory Not Exists',
                'status'=>400
            ];
        } else {
            # If SubCategory Exists
            return [
                'success'=>true,
                'data'=>$subCategory,
                'status'=>200
            ];
        }
    }

    // Delete Sub category By Category (category_id)
     public function deleteSubCategoryByCategory($category_id){
        $subCategories=subcategory::where('category_id',$category_id)->get();
        if (!$subCategories->count()>0) {
            # If Sub Categories Data Not Exists
            return [
                'success'=>false,
                'message'=>'Sub Categories Not Exists',
                'status'=>400
            ];
        } else {
            # If Sub Categories Data Exists
            foreach ($subCategories as $subCategory) {
                # code...
                $subCategory_image=$subCategory->subcategory_image;
                $this->deleteSubcategoryImage($subCategory_image);
                $subCategory->delete();
            }
        }
    }

    // Delete Sub Category  Image 
    public function deleteSubcategoryImage($imageName){
        $path = public_path('SubCategory/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
    
}