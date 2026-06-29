<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CategoryServices;
use App\Services\BannerServices;
use App\Services\PostServices;
use App\Services\ProductServices;
use App\Services\PosterServices;

class HomeController extends Controller
{
    protected $categoryServices;
    protected $bannerServices;
    protected $postServices;
    protected $productServices;
    protected $posterService;

    // Inject Attribute Image service using constructor
    public function __construct(
        CategoryServices $categoryServices,
        BannerServices $bannerServices,
        PostServices $postServices,
        ProductServices $productServices,
        PosterServices $posterService
        ){
        $this->categoryServices = $categoryServices;
        $this->bannerServices =$bannerServices;
        $this->postServices = $postServices;
        $this->productServices =$productServices;
        $this->posterService =$posterService;
    }

    // Index Home Page
    public function index(){
 
            //code...
            $categoryProduct = $this->categoryServices->productByCategories();
            $category = $this->categoryServices->GetAllCategory();
            $Banners = $this->bannerServices->getAllActiveBanner();
            $posts = $this->postServices->getAllActivePost();
            $products = $this->productServices->getProductAllDetails();
            $posters=$this->posterService->getAllActivePoster();

            $data = $categoryProduct['data'] ?? [];
            $categoryData = $category['data'] ?? [];
            $BannersData = $Banners['data'] ?? [];
            $postData = $posts['data'] ?? [];
            $productData = $products['data'] ?? [];
            $posterData = $posters['data'] ?? [];

            return view('User.index', compact('data','categoryData','BannersData','postData','productData','posterData'));
    }
}
