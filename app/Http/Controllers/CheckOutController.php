<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\CalculationServices;
use App\Services\OrderServices;

class CheckOutController extends Controller
{
    protected $calculationServices;
    protected $orderServices;

    // Inject Attribute Image service using constructor
    public function __construct(CalculationServices $calculationServices,OrderServices $orderServices){
        $this->calculationServices = $calculationServices;
        $this->orderServices = $orderServices;
    }

    //
      public function getCartProducts(Request $request)
    {
        try {
            //code...
            $cartItems = $request->cart;
            $CartProduct=$this->calculationServices->calculatePrice($cartItems);
            return response()->json($CartProduct, $CartProduct['status']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function applyCoupon(Request $request)
    {
         try {
            //code...
            $validate=Validator::make($request->all(),[
                'coupon_code'=>'required',
                'subtotal'=>'required',
            ]);
            if ($validate->fails()) {
                # code...
                return response()->json($validate->errors(), 403);
            } else {
                $data=[
                    'coupon_code'=>$request->coupon_code,
                    'subtotal'=>$request->subtotal,
                    'coupon_claim'=>$request->coupon_claim
                ];
                $response=$this->calculationServices->applyCoupon($data);
                return response()->json($response, $response['status']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

     public function placeOrder(Request $request){
         try {
            //code...
            $validate=Validator::make($request->all(),[
                'first_name'                        =>'required|string',
                'last_name'                         =>'required|string',
                'company_name'                      =>'required|string',
                'wat_number'                        =>'required|string',
                'address'                           =>'required|string',
                'city'                              =>'required|string',
                'state'                             =>'required|string',
                'country'                           =>'required|string',
                'pin_code'                          =>'required|string',
                'phone'                             =>'required|numeric|digits_between:9,12',
                'email'                             =>'required|email',
                'sub_total'                         =>'required|string',
                'tax'                               =>'required|string',
                'discount'                          =>'required|string',
                'grand_total'                       =>'required|string',
                'products'                          => 'required|array|min:1',
                'products.*.product_id'             => 'required|integer|exists:products,product_id',
                'products.*.product_variation_id'   => 'required|integer|exists:productvariations,product_variation_id',
                'products.*.quantity'               => 'required|integer|min:1',
                'products.*.price'                  => 'required|string|min:1',
                'products.*.total'                  => 'required|numeric|min:0',
            ]);
            if ($validate->fails()) {
                # code...
                return response()->json([
                    'success' => false,
                    'errors' => $validate->errors()
                ], 422);
            } else {
                # code...
                $data=[
                    'first_name'    =>$request->first_name,
                    'last_name'     =>$request->last_name,
                    'company_name'  =>$request->company_name,
                    'wat_number'    =>$request->wat_number,
                    'address'       =>$request->address,
                    'street'        =>$request->street,
                    'landmark'      =>$request->landmark,
                    'city'          =>$request->city,
                    'state'         =>$request->state,
                    'country'       =>$request->country,
                    'pin_code'      =>$request->pin_code,
                    'phone'         =>$request->phone,
                    'email'         =>$request->email,
                    'sub_total'     =>$request->sub_total,
                    'tax'           =>$request->tax,
                    'discount'      =>$request->discount,
                    'grand_total'   =>$request->grand_total,
                    'products'      =>$request->products,
                ];

                $orders=$this->orderServices->placeOrder($data);
                return response()->json($orders, $orders['status']);
            }
         } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
         }
    }

}


