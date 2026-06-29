<?php

namespace App\Services;

use App\Models\category;
use Illuminate\Support\Facades\File;

class CategoryServices {

    // Add New Category
    public function addCategory($data){
        $addCategory=category::create($data);
        if (!$addCategory) {
            # if Category Not Added
            return [
                'success'=>false,
                'message'=>'Category Not Added',
                'status'=>400
            ];
        } else {
            # if Category is Added
            return [
                'success'=>true,
                'message'=>'Category Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Categories
    public function GetAllCategory(){
        $categories=category::latest()->get();
        if (!$categories->count()>0) {
            # if Category Not Exists
            return [
                'success'=>false,
                'message'=>'Category Table is Empty',
                'status'=>400
            ];
        } else {
            # if Category Exists
            return [
                'success'=>true,
                'data'=>$categories,
                'status'=>200
            ];
        }
    }

    // Get Category
    public function getCategory($id){
        return $this->checkCategory($id);
    }

    // Update Category
    public function updateCategory($id,$data){
        $category=$this->checkCategory($id);
        if (!$category['success']) {
            # if Category Not Exists
            return $category;
        }
        $categoryData=$category['data'];
        // check Image Exists
        if (isset($data['category_image'])) {
            # If Category Image exists
            $image=$categoryData->category_image;
            $this->deleteCategoryImage($image);  # delete Category Image 
        }
        $updateCategory=$categoryData->update($data);
        if (!$updateCategory) {
            # If Category Updated
            return [
                'success'=>false,
                'message'=>'Category Not Updated',
                'status'=>400
            ];
        } else {
            # If Category Updated Successfully
            return [
                'success'=>true,
                'message'=>'Category Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Category
    public function deleteCategory($id){
        $category=$this->checkCategory($id);
        if (!$category['success']) {
            # if Category Not Exists
            return $category;
        }
        $categoryData=$category['data'];
        $image=$categoryData->category_image;
        $this->deleteCategoryImage($image);  # delete Category Image 
        $deleteCategory=$categoryData->delete();
        if (!$deleteCategory) {
            # If Category Deleted
            return [
                'success'=>false,
                'message'=>'Category Not Deleted',
                'status'=>400
            ];
        } else {
            # If Category Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Category Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Category By Id
    public function checkCategory($id){
        $category=category::find($id);
        if (!$category) {
            # If Category Not Exists
            return [
                'success'=>false,
                'message'=>'Category Not Exists',
                'status'=>400
            ];
        } else {
            # If Category Exists
            return [
                'success'=>true,
                'data'=>$category,
                'status'=>200
            ];
        }
    }

    // Delete Category Image By Category Id
    public function deleteCategoryImage($imageName)
    {
        $path = public_path('Category/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    // Get All Products BY Categories
    public function productByCategories(){
        $products = Category::with([
    'products' => function ($query) {
        $query->where('status', 1)
              ->whereHas('variations.images');
    },
    'products.variations.images',
    'products.category'
])
->whereHas('products', function ($query) {
    $query->where('status', 1)
          ->whereHas('variations.images');
})
->get();
        if (!$products->count()>0) {
            # If Products Exists
            return [
                'success'=>false,
                'message'=>'Products Table is Empty',
                'status'=>400
            ];
        } else {
            # If Products Exists
            return [
                'success'=>true,
                'data'=>$products,
                'status'=>200
            ];
        }
    }
    
}