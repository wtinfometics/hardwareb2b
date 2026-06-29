<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CalculationServices;

class CartController extends Controller
{
    //
    protected $calculationServices;

    // Inject Attribute Image service using constructor
    public function __construct(CalculationServices $calculationServices){
        $this->calculationServices = $calculationServices;
    }

    public function getCartProducts(Request $request){
        try {
            //code...
            
            $cartItems = $request->cart;
            $CartProduct=$this->calculationServices->calculatePrice($cartItems);
            return response()->json($CartProduct, $CartProduct['status']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }
}
