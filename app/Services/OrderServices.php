<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\order;
use App\Models\orderproduct;

use App\Services\ProductServices;
use App\Services\ProductVariationServices;

class OrderServices {

    protected $productService;
    protected $productVariationService;

    public function __construct(
        ProductServices $productService,
        ProductVariationServices $productVariationService
    ) {
        $this->productService = $productService;
        $this->productVariationService = $productVariationService;
    }

    // Place New order
    public function placeOrder($data){
        DB::beginTransaction();
        try {

            $productTotal = 0;
            $orderItems = [];
            
            // 1. Loop and validate products first
            foreach ($data['products'] as $item) {
                // Store for later insert
                $orderItems[] = [
                    'product_id' => $item['product_id'],
                    'product_variation_id' => $item['product_variation_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                ];
            }

            $orderNumber = rand(100000, 999999);
            $deliveryDate = Carbon::now()->addDays(7);
            // 3. Create Order
            $order = order::create([
                'subtotal'   => $data['sub_total'],
                'tax'        => $data['tax'],
                'discount'  => $data['discount'],
                'grand_total'=> $data['grand_total'],

                'order_number'=>$orderNumber,
                "delivery_date"=>$deliveryDate,
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'company_name'=> $data['company_name'],
                'wat_number'=> $data['wat_number'],
                'address'    => $data['address'],
                'street'     => $data['street'],
                'city'       => $data['city'],
                'state'      => $data['state'],
                'country'    => $data['country'],
                'pin_code'   => $data['pin_code'],
                'landmark'   => $data['landmark'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
            ]);

            // 4. Save Order Products
            foreach ($orderItems as $item) {

                orderproduct::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'product_variation_id' => $item['product_variation_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                ]);

                $variation=$this->productVariationService->getProductVariation($item['product_variation_id']);
                // Reduce stock
                $variation['data']->stock -= $item['quantity'];
                $variation['data']->save();
            }
            DB::commit();
          // Check order was saved
        if ($order && $order->exists) {

            return [
                'success' => true,
                'message' => 'Order Placed Successfully',
                'status' => 200
            ];
        }

        return [
            'success' => false,
            'message' => 'Order Not Placed',
            'status' => 400
        ];


        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // get All Orders
    public function getAllOrders(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        if (!$orders->count()>0) {
            # If Orders Not Exists
            return [
                'success'=>false,
                'message'=>'No Orders Exists',
                'status'=>400
            ];
        } else {
            # If Orders Exists
            return [
                'success'=>true,
                'data'=>$orders,
                'status'=>200
            ];
        }
    }

    // Get order
    public function getOrder($id){
        return $this->checkOrder($id);
    }

    // Update order
    public function updateOrder($id,$data){
        $order=$this->checkOrder($id);
        if (!$order['success']) {
            # If Order Dat Exists
            return $order;
        } else {
            # If Order Dat Exists
            $orderData=$order['data'];
            $updateOrder=$orderData->update($data);
            if (!$updateOrder) {
                # If Order Data Not Updated 
                return [
                    'success'=>false,
                    'message'=>'Order Data Not Updated ',
                    'status'=>400
                ];
            } else {
                # If Order Data is Updated 
                return [
                    'success'=>true,
                    'message'=>'Order Data Updated Successfully',
                    'status'=>200
                ];
            }
        }
    }

    // Delete order
    public function deleteOrder($id){
        $order=$this->checkOrder($id);
        if (!$order['success']) {
            # If Order Dat Exists
            return $order;
        } else {
            # If Order Dat Exists
            $orderData=$order['data'];
            $this->deleteOrderProduct($id);
            $deleteOrder=$orderData->delete();
            if (!$deleteOrder) {
                # If Order Data Not Deleted 
                return [
                    'success'=>false,
                    'message'=>'Order Data Not Deleted ',
                    'status'=>400
                ];
            } else {
                # If Order Data is Deleted 
                return [
                    'success'=>true,
                    'message'=>'Order Data Deleted Successfully',
                    'status'=>200
                ];
            }
        }
    }

    // Check order By Id
    public function checkOrder($id){
        $order=order::find($id);
        if (!$order) {
            # If Order Not Exists
            return [
                'success'=>false,
                'message'=>'Order Dat Not Exists',
                'status'=>400
            ];
        } else {
            # If Order Exists
            return [
                'success'=>true,
                'data'=>$order,
                'status'=>200
            ];
        }
    }

    // Delete Order Product
    public function deleteOrderProduct($order_id){
        $deleteOrderProduct=orderproduct::where('order_id',$order_id)->delete();
    }

    public function ViewOrder($order_id){
        $orderDetails=order::with([
            'orderProduct',
            'orderProduct.variation',
            'orderProduct.product'
        ])->findOrFail($order_id);
        if (!$orderDetails) {
            # If Order Data Exists
            return [
                'success'=>false,
                'message'=>'Order Details Not Exists',
                'status'=>404
            ];
        } else {
            # If Order Data Exists
            return [
                'success'=>true,
                'data'=>$orderDetails,
                'status'=>200
            ];
        }
    }
    

}