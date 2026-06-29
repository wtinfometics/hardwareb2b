<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\OrderServices;
use App\Services\ProductServices;
use App\Services\PostServices;
use App\Services\CategoryServices;
use App\Services\BrandServices;

class DashboardController extends Controller
{

    
    protected $orderServices;
    protected $productServices;
    protected $postServices;
    protected $categoryServices;
    protected $brandService;

    // Inject Attribute Image service using constructor
    public function __construct(
        OrderServices $orderServices,
        ProductServices $productServices,
        PostServices $postServices,
        CategoryServices $categoryServices,
        BrandServices $brandService,
        ){
        $this->orderServices = $orderServices;
        $this->productServices =$productServices;
        $this->postServices = $postServices;
        $this->categoryServices =$categoryServices;
        $this->brandService =$brandService;
    }

    // Index Dashboard page
    public function index(){
        try {
            //code...
            
            $orders = $this->orderServices->getAllOrders();
            $products = $this->productServices->getAllProduct();
            $posts = $this->postServices->getAllPost();
            $categories = $this->categoryServices->GetAllCategory();
            $brands = $this->brandService->getAllBrand();

            $orderData = $orders['data'] ?? [];
            $productData = $products['data'] ?? [];
            $postData = $posts['data'] ?? [];
            $categoryData = $categories['data'] ?? [];
            $brandData = $brands['data'] ?? [];

            $totalOrders=count($orderData);
            $totalProducts=count($productData);
            $totalPosts=count($postData);
            $totalCategories=count($categoryData);
            $totalBrands=count($brandData);

            $pendingOrders = collect($orderData)->where('status', 'pending')->count();
            $deliveredOrders = collect($orderData)->where('status', 'delivered')->count();
            $cancelledOrders = collect($orderData)->where('status', 'cancelled')->count();

            $activeProducts = collect($productData)->where('status', true)->count();

            $activePosts = collect($postData)->where('status', true)->count();

            $last7DaysOrders = collect($orderData)->filter(function ($order) {

            return Carbon::parse($order['created_at'])
                ->greaterThanOrEqualTo(now()->subDays(7));

    })->values();
            $data=[
                'totalOrders'=>$totalOrders,
                'totalProducts'=>$totalProducts,
                'totalPosts'=>$totalPosts,
                'totalCategories'=>$totalCategories,
                'totalBrands'=>$totalBrands,
                'pendingOrders'=>$pendingOrders,
                'deliveredOrders'=>$deliveredOrders,
                'cancelledOrders'=>$cancelledOrders,
                'activeProducts'=>$activeProducts,
                'activePosts'=>$activePosts,
                'last7DaysOrders'=>$last7DaysOrders
            ];

             return view('Admin.dashboard', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
}
