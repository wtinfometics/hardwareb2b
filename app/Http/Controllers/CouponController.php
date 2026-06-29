<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use App\Services\CouponServices;
use App\Helpers\PaginationHelper;

class CouponController extends Controller
{
    protected $couponServices;

    // Inject Attribute Image service using constructor
    public function __construct(CouponServices $couponServices){
        $this->couponServices = $couponServices;
    }

    // index Add Coupon Page
    public function indexAddCoupon(){
        return view('Admin.coupon-create');
    }

    // Create Coupon 
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'coupon_name'=>'required|string',
                'discount_type'=>'required|string',
                'discount'=>'required|numeric',
                'expiry_date'=>'required|date',
                'max_discount'=>'required|numeric',
                'status'=>'boolean',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $code = strtoupper(Str::random(6));
                $data = [
                    'coupon_name'=>$request->coupon_name,
                    'coupon_code'=>$code,
                    'discount_type'=>$request->discount_type,
                    'discount'=>$request->discount,
                    'expiry_date'=>$request->expiry_date,
                    'max_discount'=>$request->max_discount,
                    'status'=>$request->status,
                ];
                $saveCoupon = $this->couponServices->addCoupon($data);
                if ($saveCoupon['success']) {
                    return redirect('/admin/coupons')->with('success', $saveCoupon['message']);
                }
                return redirect()->back()->with('error', $saveCoupon['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Coupon
    public function index(){
        try {
            //code...
            $coupons=$this->couponServices->getAllCoupon();
            $success = $coupons['success'] ?? false;
            $message = $coupons['message'] ?? '';
            $data    = $coupons['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.coupons', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Coupon
    public function edit($coupon_id){
        try {
            //code...
            $coupon=$this->couponServices->getCoupon($coupon_id);
            $success = $coupon['success'] ?? false;
            $message = $coupon['message'] ?? '';
            $data    = $coupon['data'] ?? [];
            return view('Admin.coupon-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Coupon
    public function update(Request $request,$coupon_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'coupon_name'=>'required|string',
                'discount_type'=>'required|string',
                'discount'=>'required|numeric',
                'expiry_date'=>'required|date',
                'max_discount'=>'required|numeric',
                'status'=>'boolean',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $data = [
                    'coupon_name'=>$request->coupon_name,
                    'discount_type'=>$request->discount_type,
                    'discount'=>$request->discount,
                    'expiry_date'=>$request->expiry_date,
                    'max_discount'=>$request->max_discount,
                    'status'=>$request->status,
                ];
                $updateCoupon = $this->couponServices->updateCoupon($coupon_id,$data);
                if ($updateCoupon['success']) {
                    return redirect('/admin/coupons')->with('success', $updateCoupon['message']);
                }
                return redirect()->back()->with('error', $updateCoupon['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Coupon
    public function delete($coupon_id){
        try {
            //code...
             $deleteCoupon = $this->couponServices->deleteCoupon($coupon_id);

            if (!empty($deleteCoupon['success']) && $deleteCoupon['success'] === true) {
                return redirect()->back()->with('success', $deleteCoupon['message'] ?? 'Coupon deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteCoupon['message'] ?? 'Failed to delete Coupon.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
