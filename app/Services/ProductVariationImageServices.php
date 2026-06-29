<?php

namespace App\Services;

use App\Models\productvariationimage;
use Illuminate\Support\Facades\File;

class ProductVariationImageServices {
    
    //  Add Product variation Image
  public function addProductVariationImage($product_variation_id, $images)
{
    $createdImages = [];

    // Check images exists and is array
    if (empty($images) || !is_array($images)) {
        return [
            'success' => false,
            'message' => 'No Images Found',
            'status'  => 400,
        ];
    }

    foreach ($images as $image) {

        // Skip empty image
        if (empty($image)) {
            continue;
        }

        // Generate unique filename
        $fileName = time() . '_' . rand(1000,9999) . '.' . $image->getClientOriginalExtension();

        // Move image to folder
        $image->move(public_path('Products'), $fileName);

        // Database data
        $imgData = [
            'product_variation_image_name' => $fileName,
            'product_variation_id'         => $product_variation_id,
        ];

        // Save image
        $createdImages[] = ProductVariationImage::create($imgData);
    }

    return [
        'success' => true,
        'message' => 'Product Variation Images Added Successfully',
        'status'  => 200,
        'data'    => $createdImages,
    ];
}

    // get All Product variation Image By Product ID
    public function getAllProductVariationImages($product_variation_id){
        $productVariationImages=productvariationimage::where('product_variation_id',$product_variation_id)->get();
        if (!$productVariationImages->count()>0) {
            # if Product Variation Images Not Exists
            return [
                'success'=>false,
                'message'=>'Product Variation Images Table is Empty',
                'status'=>400
            ];
        } else {
            # if Product Variation Images Exists
            return [
                'success'=>true,
                'data'=>$productVariationImages,
                'status'=>200
            ];
        }
    }

    // Delete Product Variation Image
    public function deleteProductVariationImage($id){
        $productVariationImage=productvariationimage::find($id);
        $image=$productVariationImage->product_variation_image_name;
        $this->deleteImageFile($image);
        $deleteProductVariation=$productVariationImage->delete();
        if (!$deleteProductVariation) {
            # If Product Variation Deleted
            return [
                'success'=>false,
                'message'=>'Product Variation Not Deleted',
                'status'=>400
            ];
        } else {
            # If Product Variation Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Product Variation Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // delete Product Variation Image By Product Variation ID
    public function deleteProductVariationImageByVariationId($product_variation_id){
        $productVariationImages=productvariationimage::where('product_variation_id',$product_variation_id)->get();
        foreach ($productVariationImages as $productVariationImage) {
            # code...
            $image=$productVariationImage->product_variation_image_name;
            $this->deleteImageFile($image);
            $deleteProductVariation=$productVariationImage->delete();
        }
    }

    // Delete Product Variation Image GFile
    public function deleteImageFile($imageName){
        $path = public_path('Products/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
     
}