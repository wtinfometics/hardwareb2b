<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeVariationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\BlogController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/{category_id}', [ShopController::class, 'index']);
Route::get('/product/{product_slug}/{product_id}', [ProductDetailController::class, 'index']);
Route::post('/cart', [CartController::class, 'getCartProducts']);
Route::post('/checkout', [CheckOutController::class, 'getCartProducts']);
Route::post('/applyCoupon', [CheckOutController::class, 'applyCoupon']);
Route::post('/placeOrder', [CheckOutController::class, 'placeOrder']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{post_slug}/{post_id}', [BlogController::class, 'details']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/policy/{policy_id}/view', [PolicyController::class, 'view']);

Route::get('/cart', function () {
    return view('User.cart');
});

Route::get('/checkout', function () {
    return view('User.checkout');
});

Route::get('/contact', function () {
    return view('User.contact');
});



Route::get('/register', function () {
    return view('Admin.register');
});

Route::get('/login', function () {
    return view('Admin.login');
});

Route::get('/forget', function () {
    return view('Admin.forgetpassword');
});




// Auth Middleware Starts
Route::middleware(['admin_auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });

        Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('/attributes', [AttributeController::class, 'index']);
        Route::get('/attributes/create', [AttributeController::class, 'indexAddAttribute']);
        Route::post('/attributes', [AttributeController::class, 'store']);
        Route::get('/attributes/{attribute_id}/edit', [AttributeController::class, 'edit']);
        Route::post('/attributes/{attribute_id}', [AttributeController::class, 'update']);
        Route::delete('/attributes/{attribute_id}', [AttributeController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::post('/attributes/{attribute_id}/variations',[AttributeVariationController::class, 'store']);
        Route::get('/attributes/{attribute_id}/variations/create',[AttributeVariationController::class, 'indexAddAttributeVariation']);
        Route::get('/attributes/{attribute_id}/variations',[AttributeVariationController::class, 'index']);
        Route::get('/attributes/{attribute_id}/variations/{attribute_variation_id}/edit',[AttributeVariationController::class, 'edit']);
        Route::post('/attributes/{attribute_id}/variations/{attribute_variation_id}',[AttributeVariationController::class, 'update']);
        Route::delete('/attributes/{attribute_id}/variations/{attribute_variation_id}',[AttributeVariationController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/create', [CategoryController::class, 'createCategory']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::get('/categories/{category_id}/edit', [CategoryController::class, 'edit']);
        Route::post('/categories/{category_id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category_id}', [CategoryController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/subcategories', [SubcategoryController::class, 'index']);
        Route::get('/subcategories/create', [SubcategoryController::class, 'indexAddSubCategory']);
        Route::post('/subcategories', [SubcategoryController::class, 'store']);
        Route::get('/subcategories/{subcategory_id}/edit', [SubcategoryController::class, 'edit']);
        Route::post('/subcategories/{subcategory_id}', [SubcategoryController::class, 'update']);
        Route::delete('/subcategories/{subcategory_id}', [SubcategoryController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/brands', [BrandController::class, 'index']);
        Route::get('/brands/create', [BrandController::class, 'indexAddBrand']);
        Route::post('/brands', [BrandController::class, 'store']);
        Route::get('/brands/{brand_id}/edit', [BrandController::class, 'edit']);
        Route::post('/brands/{brand_id}', [BrandController::class, 'update']);
        Route::delete('/brands/{brand_id}', [BrandController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/banners', [BannerController::class, 'index']);
        Route::get('/banners/create', [BannerController::class, 'indexAddBanner']);
        Route::post('/banners', [BannerController::class, 'store']);
        Route::get('/banners/{banner_id}/edit', [BannerController::class, 'edit']);
        Route::post('/banners/{banner_id}', [BannerController::class, 'update']);
        Route::delete('/banners/{banner_id}', [BannerController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/policies', [PolicyController::class, 'index']);
        Route::get('/policies/create', [PolicyController::class, 'indexAddPolicy']);
        Route::post('/policies', [PolicyController::class, 'store']);
        Route::get('/policies/{policy_id}/edit', [PolicyController::class, 'edit']);
        Route::post('/policies/{policy_id}', [PolicyController::class, 'update']);
        Route::delete('/policies/{policy_id}', [PolicyController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/create', [PostController::class, 'indexAddPost']);
        Route::post('/posts', [PostController::class, 'store']);
        Route::get('/posts/{post_id}/edit', [PostController::class, 'edit']);
        Route::post('/posts/{post_id}', [PostController::class, 'update']);
        Route::delete('/posts/{post_id}', [PostController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/create', [ProductController::class, 'indexAddProduct']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{product_id}/edit', [ProductController::class, 'edit']);
        Route::post('/products/{product_id}', [ProductController::class, 'update']);
        Route::delete('/products/{product_id}', [ProductController::class, 'delete']);
        Route::get('/products/{product_id}/view', [ProductController::class, 'view']);

        Route::get('/products/{product_id}/variations/create', [ProductVariationController::class, 'addProductVariation']);
        Route::post('/products/{product_id}/variations', [ProductVariationController::class, 'store']);
        Route::get('/products/{product_id}/variations/{product_variation_id}/edit', [ProductVariationController::class, 'edit']);
        Route::post('/products/{product_id}/variations/{product_variation_id}', [ProductVariationController::class, 'update']);
        Route::delete('/products/{product_id}/variations/{product_variation_id}', [ProductVariationController::class, 'delete']);
        
        Route::delete('/products/{product_id}/variations/{product_variation_id}/image/{product_variation_image_id}', [ProductVariationController::class, 'deleteImage']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/social-media', [SocialMediaController::class, 'index']);
        Route::post('/social-media', [SocialMediaController::class, 'store']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/company', [CompanyController::class, 'index']);
        Route::post('/company', [CompanyController::class, 'store']);
    });

    Route::get('/admin/profile', function () {
        return view('Admin.profile');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/coupons', [CouponController::class, 'index']);
        Route::get('/coupons/create', [CouponController::class, 'indexAddCoupon']);
        Route::post('/coupons', [CouponController::class, 'store']);
        Route::get('/coupons/{coupon_id}/edit', [CouponController::class, 'edit']);
        Route::post('/coupons/{coupon_id}', [CouponController::class, 'update']);
        Route::delete('/coupons/{coupon_id}', [CouponController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{order_id}/view', [OrderController::class, 'view']);
        Route::get('/orders/{order_id}/edit', [OrderController::class, 'edit']);
        Route::post('/orders/{order_id}', [OrderController::class, 'update']);
        Route::get('/orders/{order_id}/invoice', [OrderController::class, 'invoice']);
        Route::delete('/orders/{order_id}', [OrderController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::post('/LogOut', [AdminController::class, 'logOut']);
        Route::get('/admin/profile', [AdminController::class, 'viewAdmin']);
        Route::get('/admin/update', [AdminController::class, 'updateAdmin']);
        Route::get('/admin/updatePassword', [AdminController::class, 'updatePassword']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/profile', [AdminController::class, 'viewAdmin']);
        Route::get('/logout', [AdminController::class, 'logOut']);
        Route::post('/update', [AdminController::class, 'updateAdmin']);
        Route::post('/updatePassword', [AdminController::class, 'updatePassword']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/backup', [BackupController::class, 'index']);
        Route::get('/backup/create', [BackupController::class, 'create']);
        Route::get('/backup/restore', [BackupController::class, 'indexRestore']);
        Route::post('/backup/restore', [BackupController::class, 'indexAddBanner']);
        Route::get('/backup/{backup_id}/download', [BackupController::class, 'download']);
        Route::delete('/backup/{backup_id}', [BackupController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/posters', [PosterController::class, 'index']);
        Route::get('/posters/create', [PosterController::class, 'indexAddPoster']);
        Route::post('/posters', [PosterController::class, 'store']);
        Route::get('/posters/{poster_id}/edit', [PosterController::class, 'edit']);
        Route::post('/posters/{poster_id}', [PosterController::class, 'update']);
        Route::delete('/posters/{poster_id}', [PosterController::class, 'delete']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::get('/contacts/{contact_id}/view', [ContactController::class, 'view']);
        Route::delete('/contacts/{contact_id}', [ContactController::class, 'delete']);
    });

});
// Auth Middleware Ends

// Rest Middleware Starts
Route::middleware(['reset'])->group(function () {
   Route::post('/verify', [AdminController::class, 'verifyOTP']);
    Route::post('/reset', [AdminController::class, 'resetPassword']);

    Route::get('/verify', function () {
    return view('Admin.verifyotp');
});

    Route::get('/reset', function () {
        return view('Admin.resetpassword');
    });

});

// Rest Middleware Ends
    Route::post('/register', [AdminController::class, 'registerAdmin']);
    Route::post('/login', [AdminController::class, 'logIn']);
    Route::post('/forget', [AdminController::class, 'forgetPassword']);
    