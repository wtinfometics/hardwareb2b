<?php

namespace App\Services;

use App\Models\productvariation;

use App\Services\ProductVariationImageServices;
use App\Services\ProductVariationAttributeServices;

class ProductVariationServices {

    protected $productVariationImageServices;
    protected $productVariationAttributeServices;

    // Inject Product Variation Image service using constructor
    public function __construct(ProductVariationImageServices $productVariationImageServices,ProductVariationAttributeServices $productVariationAttributeServices){
        $this->productVariationImageServices = $productVariationImageServices;
        $this->productVariationAttributeServices = $productVariationAttributeServices;
    }

    // Add New Product Variation
    public function addProductVariation($data,$attributeData,$productImage){
        $addProductVariation=productvariation::create($data);
        if (!$addProductVariation) {
            # if Product Variation Not Added
            return [
                'success'=>false,
                'message'=>'Product Variation Not Added',
                'status'=>400
            ];
        } else {
            # if Product Variation is Added
            $product_variation_id = $addProductVariation->product_variation_id;
            $this->productVariationAttributeServices->addAndUpdateVariation($product_variation_id,$attributeData);
            $this->productVariationImageServices->addProductVariationImage($product_variation_id,$productImage);
            return [
                'success'=>true,
                'message'=>'Product Variation Added Successfully',
                'status'=>200
            ];
        }
    }

    // Get Product Variation All Variations By Product
    public function getAllProductVariations($product_id){
        $productVariations=productvariation::where('product_id',$product_id)->get();
        if (!$productVariations->count()>0) {
            # if Product Variation Not Exists
            return [
                'success'=>false,
                'message'=>'Product Variation Table is Empty',
                'status'=>400
            ];
        } else {
            # if Product Variation Exists
            return [
                'success'=>true,
                'data'=>$productVariations,
                'status'=>200
            ];
        }
    }

    // Get Product variation
    public function getProductVariation($id){
        return $this->checkProductVariation($id);
    }

    // Update Product Variation
    public function updateProductVariation($product_variation_id,$data,$attributeData,$productImage){
        $productVariation=$this->checkProductVariation($product_variation_id);
        if (!$productVariation['success']) {
            # if Product Variation Not Exists
            return $productVariation;
        }
        $productVariationData=$productVariation['data'];
        $updateProductVariation=$productVariationData->update($data);
         if (!$updateProductVariation) {
            # If Product Variation Updated
            return [
                'success'=>false,
                'message'=>'Product Variation Not Updated',
                'status'=>400
            ];
        } else {
            # If Product Variation Updated Successfully
            $this->productVariationAttributeServices->addAndUpdateVariation($product_variation_id,$attributeData);
            $this->productVariationImageServices->addProductVariationImage($product_variation_id,$productImage);
            return [
                'success'=>true,
                'message'=>'Product Variation Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Product variation
    public function deleteProductVariation($product_variation_id){
        $productVariation=$this->checkProductVariation($product_variation_id);
        if (!$productVariation['success']) {
            # if Product Variation Not Exists
            return $productVariation;
        }
        $productVariationData=$productVariation['data'];
        $this->productVariationImageServices->deleteProductVariationImageByVariationId($product_variation_id);  # Delete Product VariationImages
        $this->productVariationAttributeServices->deleteVariationAttribute($product_variation_id);  # Delete Product Variation Attribute
        $deleteProductVariation=$productVariationData->delete();
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

    // check Product Vat5ion By Variation ID
    public function checkProductVariation($id){
        $productVariation=productvariation::find($id);
        if (!$productVariation) {
            # If Product Variation Not Exists
            return [
                'success'=>false,
                'message'=>'Product Variation Not Exists',
                'status'=>400
            ];
        } else {
            # If Product Variation Exists
            return [
                'success'=>true,
                'data'=>$productVariation,
                'status'=>200
            ];
        }
    }

    // delete All Product Variation 
    public function deleteAllProductVariation($product_id){
        $productVariations=productvariation::where('product_id',$product_id)->get();
        foreach ($productVariations as $productVariations ) {
            $product_variation_id=$productVariations->product_variation_id;
            $this->deleteProductVariation($product_variation_id);
            $productVariations->delete();
        }
    }
}