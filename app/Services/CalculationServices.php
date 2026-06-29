<?php
namespace App\Services;

use App\Models\brand;
use Illuminate\Support\Facades\File;

use App\Models\productvariation;

use App\Services\CouponServices;

class CalculationServices {

    protected $couponServices;

    // Inject Attribute Image service using constructor
    public function __construct(CouponServices $couponServices){
        $this->couponServices = $couponServices;
    }

    // Calculate Product Price
    public function calculatePrice($data){
        $response = [];
        $subTotal = 0;
        foreach ($data as $item) {
            $variation = productvariation::with('product')
            ->where('product_variation_id',$item['product_variation_id']
            )->first();
            if (!$variation) {
                # If Variation Not Exists
                continue;
            }else{
                # If Variation  Exists
                if ($variation->product->min_order>= $item['quantity']) {
                    # Stock Not Exists
                    continue;
                } else {
                    $price = $variation->discount_price ?? $variation->price;
                    $total = $price * $item['quantity'];
                    # Stock Exists
                    $subTotal += $total;
                    $response[] = [
                        'product_id'            => $variation->product->product_id,
                        'product_variation_id'  => $variation->product_variation_id,
                        'product_name'          => $variation->product->product_name,
                        'variation_name'        => $variation->variation_name,
                        'quantity'              => $item['quantity'],
                        'price'                 => $price,
                        'total'                 => $total
                    ];
                }         
            }
        }   
        $tax = ($subTotal * 5) / 100;
        $grandTotal = $subTotal + $tax;
        return [
            'products'      => $response,
            'sub_total'     => round($subTotal, 2),
            'tax'           => round($tax, 2),
            'grand_total'   => round($grandTotal, 2),
            'status'        => 200
        ];
    }
    
    // apply Coupon code
    public function applyCoupon($data){
        if ( $data['coupon_claim'] == 1) {
            # code...
            return [
                'success' => false,
                'message' => 'Coupon already claimed',
                'status'  =>  400
            ];
        }
        # code...
        $couponCode = $data['coupon_code'];
        $subtotal = $data['subtotal'];
        // SAMPLE COUPON
        $coupon=$this->couponServices->getCouponByCode($couponCode);
        if (!$coupon['success']) {
            # code...
            return [
            'success'           => false,
            'message'           => $coupon['message'],
            'discount_amount'   => 0,
            'coupon_claim'      => 0,
            'status'            => 400
            ];
        }
        $finalDiscount=0;
        $discountData=$coupon['data'];
        $discountType=$discountData->discount_type;
        $maxDiscount=$discountData->max_discount;
        if ($discountType=='percentage') {
            # code...
            $discount=$subtotal*$discountData->discount/100;
            if ($discount>=$maxDiscount) {
                # discount is Greater Than Maximum Discount 
                $finalDiscount=$maxDiscount;
            }
            $finalDiscount=$discount;
        } else {
            # code...
            $finalDiscount=$discountData->discount;
        }
        $newSubtotal=$subtotal-$finalDiscount;  # New Sub Total
        $tax =($newSubtotal * 5) / 100;
        $grandTotal = $newSubtotal - $tax;
        return [
            'success'       => true,
            'sub_total'     => round($subtotal, 2),
            'discount'      => round($finalDiscount, 2),
            'tax'           => round($tax, 2),
            'coupon_claim'  => 1,
            'grand_total'   => round($grandTotal, 2),
            'status'        => 200
        ];
    }

}