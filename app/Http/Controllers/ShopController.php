<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\product;
use App\Models\category;
use App\Models\subcategory;
use App\Models\brand;

use App\Helpers\PaginationHelper;

class ShopController extends Controller
{
    // Index Shop Page
    public function index(Request $request,$category_id=null)
{
    $query = Product::with([
        'brand',
        'category',
        'subcategory',
        'variations.images'
    ])
    ->where('status', 1)
    ->whereHas('variations')
    ->whereHas('variations.images');

    /*
    |--------------------------------------------------------------------------
    | CATEGORY FILTER
    |--------------------------------------------------------------------------
    */
    if ($category_id) {
        $query->where(
            'category_id',
            $category_id
        );
    }

    if ($request->categories) {

        $query->whereIn(
            'category_id',
            $request->categories
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SUBCATEGORY FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->subcategories) {

        $query->whereIn(
            'subcategory_id',
            $request->subcategories
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BRAND FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->brands) {

        $query->whereIn(
            'brand_id',
            $request->brands
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->search) {

        $query->where(function($q) use ($request){

            $q->where(
                'product_name',
                'LIKE',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'description',
                'LIKE',
                '%' . $request->search . '%'
            );

        });
    }

    /*
    |--------------------------------------------------------------------------
    | PRICE FILTER
    |--------------------------------------------------------------------------
    */

    if ($request->max_price) {

        $query->whereHas('variations', function($q) use ($request){

            $q->where(
                'discount_price',
                '<=',
                $request->max_price
            );

        });
    }

    /*
    |--------------------------------------------------------------------------
    | SORTING
    |--------------------------------------------------------------------------
    */

    if ($request->sort_by == 'low_to_high') {

        $query->join(
            'productvariations',
            'products.product_id',
            '=',
            'productvariations.product_id'
        )
        ->orderBy(
            'productvariations.discount_price',
            'ASC'
        );

    }

    elseif ($request->sort_by == 'high_to_low') {

        $query->join(
            'productvariations',
            'products.product_id',
            '=',
            'productvariations.product_id'
        )
        ->orderBy(
            'productvariations.discount_price',
            'DESC'
        );

    }

    else {

        $query->latest();
    }

    $products = $query
        ->select('products.*')
        ->distinct()
        ->paginate(15);

    $categories = category::all();

    $subcategories = subcategory::all();

    $brands = brand::all();

    return view(
        'User.shop',
        compact(
            'products',
            'categories',
            'subcategories',
            'brands'
        )
    );
}
}
