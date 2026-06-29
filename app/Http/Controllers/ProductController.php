<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use App\Services\ProductServices;
use App\Services\SubCategoryServices;
use App\Services\CategoryServices;
use App\Services\BrandServices;
use App\Services\ProductVariationServices;

use App\Helpers\PaginationHelper;

class ProductController extends Controller
{
    protected $productServices;
    protected $subcategoryServices;
    protected $categoryServices;
    protected $brandServices;
    protected $productVariationServices;

    // Inject Attribute Image service using constructor
    public function __construct(
        ProductServices $productServices,
        SubCategoryServices $subcategoryServices,
        CategoryServices $categoryServices,
        BrandServices $brandServices,
        ProductVariationServices $productVariationServices,
    ){
        $this->productServices = $productServices;
        $this->subcategoryServices = $subcategoryServices;
        $this->categoryServices = $categoryServices;
        $this->brandServices = $brandServices;
        $this->productVariationServices = $productVariationServices;
    }

    // index Crete Product Page
    public function indexAddProduct(){
        try {
            //code...
            $categories     = $this->categoryServices->GetAllCategory();
            $subcategories  = $this->subcategoryServices->getAllSubCategory();
            $brands         = $this->brandServices->getAllBrand();

            return view('Admin.product-create', [
                'categories'    => $categories['data'] ?? [],
                'subcategories' => $subcategories['data'] ?? [],
                'brands'        => $brands['data'] ?? [],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Create Product
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'product_name'      =>'required|string',
                'category_id'       =>'required|exists:categories,category_id',
                'subcategory_id'    =>'required|exists:subcategories,subcategory_id',
                'brand_id'          =>'required|exists:brands,brand_id',
                'min_order'         =>'required|numeric',
                'promoted'          =>'required|boolean',
                'featured'          =>'required|boolean',
                'description'       =>'required|string',
                'meta_title'        =>'required|string',
                'meta_description'  =>'required|string',
                'meta_keywords'     =>'required|string',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $slug=Str::slug($request->product_name);
                $data = [
                    'product_name'      =>$request->product_name,
                    'product_slug'      =>$slug,
                    'category_id'       =>$request->category_id,
                    'subcategory_id'    =>$request->subcategory_id,
                    'brand_id'          =>$request->brand_id,
                    'min_order'         =>$request->min_order,
                    'promoted'          =>$request->promoted,
                    'featured'          =>$request->featured,
                    'description'       =>$request->description,
                    'status'            =>$request->status,
                ];

                $metadata=[
                    'meta_title'        =>$request->meta_title,
                    'meta_description'  =>$request->meta_description,
                    'meta_keywords'     =>$request->meta_keywords
                ];

                $saveProduct = $this->productServices->addProduct($data,$metadata);
                if ($saveProduct['success']) {
                    return redirect('/admin/products')->with('success', $saveProduct['message']);
                }
                return redirect()->back()->with('error', $saveProduct['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Products
    public function index(){
        try {
            //code...
            $Products = $this->productServices->getAllProductWithCategory();

            $success = $Products['success'] ?? false;
            $message = $Products['message'] ?? '';
            $data    = $Products['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.products', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Product
    public function edit($product_id){
        try {
            //code...
            $categories     = $this->categoryServices->GetAllCategory();
            $subcategories  = $this->subcategoryServices->getAllSubCategory();
            $brands         = $this->brandServices->getAllBrand();
            $product        = $this->productServices->getProduct($product_id);

            $success    = $product['success'] ?? false;
            $message    = $product['message'] ?? '';
            $data       = $product['data'] ?? [];
            $metaData   = $product['metaData'] ?? [];

            $categories    = $categories['data'] ?? [];
            $subcategories = $subcategories['data'] ?? [];
            $brands        = $brands['data'] ?? [];

            return view('Admin.product-create', compact('success', 'message', 'data','metaData','categories','subcategories','brands',));
       
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Product
    public function update(Request $request,$product_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'product_name'      =>'required|string',
                'category_id'       =>'required|exists:categories,category_id',
                'subcategory_id'    =>'required|exists:subcategories,subcategory_id',
                'brand_id'          =>'required|exists:brands,brand_id',
                'min_order'         =>'required|numeric',
                'promoted'          =>'required|boolean',
                'featured'          =>'required|boolean',
                'description'       =>'required|string',
                'status'            =>'required|boolean',
                'meta_title'        =>'required|string',
                'meta_description'  =>'required|string',
                'meta_keywords'     =>'required|string',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $slug=Str::slug($request->product_name);
                $data = [
                    'product_name'      =>$request->product_name,
                    'product_slug'      =>$slug,
                    'category_id'       =>$request->category_id,
                    'subcategory_id'    =>$request->subcategory_id,
                    'brand_id'          =>$request->brand_id,
                    'min_order'         =>$request->min_order,
                    'promoted'          =>$request->promoted,
                    'featured'          =>$request->featured,
                    'description'       =>$request->description,
                    'status'            =>$request->status,
                ];

                $metaData=[
                    'meta_title'        =>$request->meta_title,
                    'meta_description'  =>$request->meta_description,
                    'meta_keywords'     =>$request->meta_keywords
                ];

                $updateProduct = $this->productServices->updateProduct($product_id,$data,$metaData);
                if ($updateProduct['success']) {
                    return redirect('/admin/products')->with('success', $updateProduct['message']);
                }
                return redirect()->back()->with('error', $updateProduct['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Product
    public function delete($product_id){
        try {
            //code...
            $deleteProduct = $this->productServices->deleteProduct($product_id);

            if (!empty($deleteProduct['success']) && $deleteProduct['success'] === true) {
                return redirect()->back()->with('success', $deleteProduct['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteProduct['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function view($product_id){
        try {
            //code...
            $product            = $this->productServices->getProduct($product_id);
            $productVariation   = $this->productVariationServices->getAllProductVariations($product_id);

            $success    = $product['success'] ?? false;
            $message    = $product['message'] ?? '';
            $data       = $product['data'] ?? [];

            $PVSuccess    = $productVariation['success'] ?? false;
            $PVMessage    = $productVariation['message'] ?? '';
            $PVData       = $productVariation['data'] ?? [];

            $paginatedData = PaginationHelper::paginate($PVData, 10);

            return view('Admin.product-view', compact('success', 'message', 'data','PVSuccess','PVMessage','paginatedData','product_id'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

}
