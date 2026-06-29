<?php

namespace App\Services;
use App\Models\product;

use App\Services\ProductMetaServices;
use App\Services\ProductVariationServices;

class ProductServices {

   protected $productMetaService;
   protected $productVariationService;

    // Inject Attribute Image service using constructor
    public function __construct(ProductMetaServices $productMetaService,ProductVariationServices $productVariationService ){
        $this->productMetaService = $productMetaService;
        $this->productVariationService =$productVariationService;
    }

    // Add New Product
    public function addProduct($data,$metadata){
        $addProduct=product::create($data);
        if (!$addProduct) {
            # if Product Not Added
            return [
                'success'=>false,
                'message'=>'Product Not Added',
                'status'=>400
            ];
        } else {
            # if Product is Added
            $id=$addProduct->product_id;
            $saveProductMetaData=$this->productMetaService->addProductMetaData($id,$metadata);
            if (!$saveProductMetaData['success']) {
                # code...
                return $saveProductMetaData;
            }
            return [
                'success'=>true,
                'message'=>'Product Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Products
    public function getAllProduct(){
        $products=product::latest()->get();
        if (!$products->count()>0) {
            # if Product Not Exists
            return [
                'success'=>false,
                'message'=>'Product Table is Empty',
                'status'=>400
            ];
        } else {
            # if Product Exists
            return [
                'success'=>true,
                'data'=>$products,
                'status'=>200
            ];
        }
    }

     // get All Products with Category
    public function getAllProductWithCategory(){
        $products=product::with('category')->get();
        if (!$products->count()>0) {
            # if Product Not Exists
            return [
                'success'=>false,
                'message'=>'Product Table is Empty',
                'status'=>400
            ];
        } else {
            # if Product Exists
            return [
                'success'=>true,
                'data'=>$products,
                'status'=>200
            ];
        }
    }

    // Get Product
    public function getProduct($id){
        return $this->checkProduct($id);
    }

    // Update Product
    public function updateProduct($id,$data,$metaData){
        $product=$this->checkProduct($id);
        if (!$product['success']) {
            # if Product Not Exists
            return $product;
        }
        $productData=$product['data'];
        $updateProduct=$productData->update($data);
        if (!$updateProduct) {
            # If Product Updated
            return [
                'success'=>false,
                'message'=>'Product Not Updated',
                'status'=>400
            ];
        } else {
            $saveProductMetaData=$this->productMetaService->addProductMetaData($id,$metaData);
            if (!$saveProductMetaData['success']) {
                # code...
                return $saveProductMetaData;
            }
            # If Product Updated Successfully
            return [
                'success'=>true,
                'message'=>'Product Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Product
    public function deleteProduct($id){
        $product=$this->checkProduct($id);
        if (!$product['success']) {
            # if Product Not Exists
            return $product;
        }
        $productData=$product['data'];
        $this->productMetaService->deleteProductMeta($id);  # Delete Product Meta
        $this->productVariationService->deleteAllProductVariation($id);  # Delete All Product Variation
        $deleteProduct=$productData->delete();
        if (!$deleteProduct) {
            # If Product Deleted
            return [
                'success'=>false,
                'message'=>'Product Not Deleted',
                'status'=>400
            ];
        } else {
            # If Product Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Product Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Product By Id
    public function checkProduct($id){
        $product=product::find($id);
        
        if (!$product) {
            # If Product Not Exists
            return [
                'success'=>false,
                'message'=>'Product Not Exists',
                'status'=>400
            ];
        } else {
            $productMetaData=$this->productMetaService->getProductMetaData($id);        # Get Product Meta Data
            if (!$productMetaData) {
                # if Product meta Dat Not Exists
                return $productMetaData;
            }
            # If Product Exists
            return [
                'success'   =>true,
                'data'      =>$product,
                'metaData' => $productMetaData['data'] ?? [],
                'status'    =>200
            ];
        }
    }
    
    // Get complete Product Details
    public function getProductDetailsCompletely($id){
        $product = product::with(['category','subcategory','brand'])->find($id);
        
        if (!$product) {
            # If Product Not Exists
            return [
                'success'=>false,
                'message'=>'Product Not Exists',
                'status'=>400
            ];
        } else {
            # If Product Exists
            return [
                'success'   =>true,
                'data'      =>$product,
                'status'    =>200
            ];
        }
    }

    public function getProductAllDetails(){
       $products = product::with([
    'category',
    'variations.images',
])
->where('status', 1)
->whereHas('variations.images')
->get();
    if (!$products->count()>0) {
            # if Product Not Exists
            return [
                'success'=>false,
                'message'=>'Product Table is Empty',
                'status'=>400
            ];
        } else {
            # if Product Exists
            return [
                'success'=>true,
                'data'=>$products,
                'status'=>200
            ];
        }
    }


}