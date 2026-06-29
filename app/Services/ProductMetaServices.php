<?php

namespace App\Services;

use App\Models\productmeta;

class ProductMetaServices {

    // Add And Update Product Meta
    public function addProductMetaData($id,$data){
        $insertProductMeta = productmeta::updateOrCreate(
            ['product_id' => $id], // condition
            $data // values to update or insert
        );
        if (!$insertProductMeta) {
            # If Product Meta Data Not inserted
            return [
                'success'=>false,
                'message'=>'Product Meta Data Not Inserted',
                'status'=>400
            ];
        } else {
            # If Product Meta Data inserted
            return [
                'success'=>true,
                'message'=>'Product Meta Data is Inserted',
                'status'=>200
            ];
        }
    }

    // Get Product Meta
    public function getProductMetaData($product_id){
        $ProductMeta=productmeta::where('product_id',$product_id)->first();
        if ( !$ProductMeta) {
            # If Product meta Exists
            return [
                'success'=>false,
                'message'=>'Product meta Not exists',
                'status'=>400
            ];
        } else {
            # If Product meta Exists
            return [
                'success'=>true,
                'data'=>$ProductMeta,
                'status'=>200
            ];
        }
    }

    // Delete Product Meta
    public function deleteProductMeta($product_id){
        $deleteProductMeta=productmeta::where('product_id',$product_id)->delete();
        if (!$deleteProductMeta) {
            # if Product meta data Not Deleted 
            return [
                'success'=>false,
                'message'=>'Product Meta Data is Deleted',
                'status'=>400
            ];
        } else {
            # if Product meta data is Deleted 
            return [
                'success'=>false,
                'message'=>'Product Meta Data is Deleted Successfully',
                'status'=>400
            ];
        }
    }

}