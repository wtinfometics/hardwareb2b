<?php

namespace App\Services;
use Carbon\Carbon;

use App\Models\coupon;

class CouponServices {

    // Add New Coupon
    public function addCoupon($data){
        $addCoupon=coupon::create($data);
        if (!$addCoupon) {
            # if Coupon Not Added
            return [
                'success'=>false,
                'message'=>'Coupon Not Added',
                'status'=>400
            ];
        } else {
            # if Coupon is Added
            return [
                'success'=>true,
                'message'=>'Coupon Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Coupons
    public function getAllCoupon(){
        $Coupons=coupon::latest()->get();
        if (!$Coupons->count()>0) {
            # if Coupon Not Exists
            return [
                'success'=>false,
                'message'=>'Coupon Table is Empty',
                'status'=>400
            ];
        } else {
            # if Coupon Exists
            return [
                'success'=>true,
                'data'=>$Coupons,
                'status'=>200
            ];
        }
    }

    // Get Coupon
    public function getCoupon($id){
        return $this->checkCoupon($id);
    }

    // Update Coupon
    public function updateCoupon($id,$data){
        $coupon=$this->checkCoupon($id);
        if (!$coupon['success']) {
            # if Coupon Not Exists
            return $coupon;
        }
        $couponData=$coupon['data'];
        $updateCoupon=$couponData->update($data);
        if (!$updateCoupon) {
            # If Coupon Updated
            return [
                'success'=>false,
                'message'=>'Coupon Not Updated',
                'status'=>400
            ];
        } else {
            # If Coupon Updated Successfully
            return [
                'success'=>true,
                'message'=>'Coupon Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Coupon
    public function deleteCoupon($id){
        $coupon=$this->checkCoupon($id);
        if (!$coupon['success']) {
            # if Coupon Not Exists
            return $coupon;
        }
        $couponData=$coupon['data'];
        $deleteCoupon=$couponData->delete();
        if (!$deleteCoupon) {
            # If Coupon Deleted
            return [
                'success'=>false,
                'message'=>'Coupon Not Deleted',
                'status'=>400
            ];
        } else {
            # If Coupon Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Coupon Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Coupon By Id
    public function checkCoupon($id){
        $coupon=coupon::find($id);
        if (!$coupon) {
            # If Coupon Not Exists
            return [
                'success'=>false,
                'message'=>'Coupon Not Exists',
                'status'=>400
            ];
        } else {
            # If Coupon Exists
            return [
                'success'=>true,
                'data'=>$coupon,
                'status'=>200
            ];
        }
    }

    // Get coupon code By Code
    public function getCouponByCode($code){
        $coupon=coupon::where('coupon_code',$code)->first();
        if (!$coupon) {
            # If Coupon Not Exists
            return [
                'success'=>false,
                'message'=>'Coupon Not Exists',
                'status'=>400
            ];
        } else {
            # If Coupon Exists
            if (Carbon::parse($coupon->expiry_date)->isPast()) {
                    return [
                    'success'=>false,
                    'message'=>'Coupon is Expired',
                    'status'=>400
                ];
            }
            return [
                'success'=>true,
                'data'=>$coupon,
                'status'=>200
            ];
        }
    }
    

}