<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\product;

class ProductDetailController extends Controller
{
    //
    public function index($product_slug,$id){
        try {
            //code...
            $product = product::with([
                'brand',
                'category',
                'subcategory',
                'meta',

                'variations.images',

                'variations.attributes.attribute',

                'variations.attributes.attributeVariation'
            ])->findOrFail($id);
            return view('User.productdetails', compact('product'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
