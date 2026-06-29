<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\ProductVariationServices;
use App\Services\AttributeServices;
use App\Services\ProductVariationAttributeServices;
use App\Services\ProductVariationImageServices;

class ProductVariationController extends Controller
{
     protected $productVariationServices;
     protected $attributeServices;
     protected $productVariationAttributeServices;
     protected $productVariationImageServices;

    // Inject Attribute Image service using constructor
    public function __construct(
            ProductVariationServices $productVariationServices,
            AttributeServices $attributeServices,
            ProductVariationAttributeServices $productVariationAttributeServices,
            ProductVariationImageServices $productVariationImageServices,
         ){
        $this->productVariationServices = $productVariationServices;
        $this->attributeServices = $attributeServices;
        $this->productVariationAttributeServices = $productVariationAttributeServices;
        $this->productVariationImageServices = $productVariationImageServices;
    }

    // index Add Product Variation
    public function addProductVariation($product_id){
        $attributeVariations=$this->attributeServices->relatedAttributeVariation();
        $attributesData=$attributeVariations['data']??[];
        return view('Admin.product-variation-create',compact('product_id','attributesData'));
    }

    // Create Product Variation
    public function store(Request $request,$product_id){
        try {
            //code...
             $validate=Validator::make($request->all(),[
                'variation_name'                        =>'required|string',
                'short_description'                     =>'required|string',
                'price'                                 =>'required|numeric',
                'discount_price'                        =>'required|string',
                'stock'                                 =>'required|numeric',
                'attributes'                            => 'required|array',
                'attributes.*.attribute_id'             => [
                                                                'nullable',
                                                                'exclude_if:attributes.*.attribute_variation_id,null',
                                                                'exists:attributes,attribute_id',
                                                            ],
                'attributes.*.attribute_variation_id'   => [
                                                                'nullable',
                                                                'exclude_if:attributes.*.attribute_id,null',
                                                                'exists:attributevariations,attribute_variation_id',
                                                            ],
                'product_image'                         => 'required|array',
                'product_image.*'                       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=500,height=400',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $sku = random_int(1000000, 9999999);
                $data = [
                    'variation_name'    =>$request->variation_name,
                    'short_description' =>$request->short_description,
                    'sku'               =>$sku,
                    'price'             =>$request->price,
                    'product_id'        =>$product_id,
                    'discount_price'    =>$request->discount_price,
                    'stock'             =>$request->stock,
                ];
                $attributes=$request->input('attributes'); # Product Attribute Variations
                $image=$request->file('product_image');  # Product Attribute Variations Images
                $saveProduct = $this->productVariationServices->addProductVariation($data,$attributes,$image);
                if ($saveProduct['success']) {
                    return redirect('/admin/products/'.$product_id.'/view')->with('success', $saveProduct['message']);
                }
                return redirect()->back()->with('error', $saveProduct['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }



    // Vew Product Variation
    public function edit($product_id,$product_variation_id){
        try {
            //code...
            $attributeVariations        =   $this->attributeServices->relatedAttributeVariation();
            $productVariation           =   $this->productVariationServices->getProductVariation($product_variation_id);
            $productVariationAttributeData =   $this->productVariationAttributeServices->getVariation($product_variation_id);
            $productVariationImages     =   $this->productVariationImageServices->GetAllProductVariationImages($product_variation_id);

            $attributesData                 =   $attributeVariations['data']??[];
            $productVariationData           =   $productVariation['data'];
            $productVariationImagesData           =   $productVariationImages['data']??[];

            return view('Admin.product-variation-create',compact(
                'product_id','product_variation_id','attributesData','productVariationData',
                'productVariationAttributeData','productVariationImagesData'));

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Product Variation 
    public function update(Request $request,$product_id,$product_variation_id){
        try {
            //code...
             $validate=Validator::make($request->all(),[
                'variation_name'                        =>'required|string',
                'short_description'                     =>'required|string',
                'price'                                 =>'required|numeric',
                'discount_price'                        =>'required|string',
                'stock'                                 =>'required|numeric',
                'attributes'                            => 'required|array',
                'attributes.*.attribute_id'             => [
                                                                'nullable',
                                                                'exclude_if:attributes.*.attribute_variation_id,null',
                                                                'exists:attributes,attribute_id',
                                                            ],
                'attributes.*.attribute_variation_id'   => [
                                                                'nullable',
                                                                'exclude_if:attributes.*.attribute_id,null',
                                                                'exists:attributevariations,attribute_variation_id',
                                                            ],
                'product_image'                         => 'array',
                'product_image.*'                       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=500,height=400',
            ], [
    'product_image.*.dimensions' => 'Each product image must be exactly 500x400 pixels.',
    'product_image.*.image' => 'Each file must be an image.',
    'product_image.*.mimes' => 'Allowed formats: jpg, jpeg, png, webp.',
]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $data = [
                    'variation_name'    =>$request->variation_name,
                    'short_description' =>$request->short_description,
                    'price'             =>$request->price,
                    'product_id'        =>$product_id,
                    'discount_price'    =>$request->discount_price,
                    'stock'             =>$request->stock,
                ];
                $attributes=$request->input('attributes'); # Product Attribute Variations
                $image=$request->file('product_image');  # Product Attribute Variations Images
                $saveProduct = $this->productVariationServices->updateProductVariation($product_variation_id,$data,$attributes,$image);
                if ($saveProduct['success']) {
                    return redirect('/admin/products/'.$product_id.'/view')->with('success', $saveProduct['message']);
                }
                return redirect()->back()->with('error', $saveProduct['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Product Variation
    public function delete($product_id,$product_variation_id){
        try {
            //code...
            $deleteProductVariation = $this->productVariationServices->deleteProductVariation($product_variation_id);

            if (!empty($deleteProductVariation['success']) && $deleteProductVariation['success'] === true) {
                return redirect()->back()->with('success', $deleteProductVariation['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteProductVariation['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // delete Product Variation Image
    public function deleteImage($product_id,$product_variation_id, $product_variation_image_id){
         try {
            //code...
            $deleteProductImages = $this->productVariationImageServices->deleteProductVariationImage($product_variation_image_id);

            if (!empty($deleteProductImages['success']) && $deleteProductImages['success'] === true) {
                return redirect()->back()->with('success', $deleteProductImages['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteProductImages['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

}
