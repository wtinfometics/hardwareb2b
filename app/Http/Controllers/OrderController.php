<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Services\OrderServices;
use App\Services\CompanyServices;
use App\Helpers\PaginationHelper;

class OrderController extends Controller
{
    protected $orderServices;
     protected $companyServices;

    // Inject Attribute Image service using constructor
    public function __construct(OrderServices $orderServices,CompanyServices $companyServices ){
        $this->orderServices = $orderServices;
        $this->companyServices = $companyServices;
    }
    // View All Orders
    public function index(){
        try {
            //code...
            $orders=$this->orderServices->getAllOrders();
            $success = $orders['success'] ?? false;
            $message = $orders['message'] ?? '';
            $data    = $orders['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.orders', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Order Page
    public function edit($order_id){
        try {
            //code...
            $order=$this->orderServices->getOrder($order_id);
            $success = $order['success'] ?? false;
            $message = $order['message'] ?? '';
            $data    = $order['data'] ?? [];
            
            return view('Admin.order-edit', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    /// update Order
    public function update(Request $request,$order_id){
         try {
            //code...
            $validate=Validator::make($request->all(),[
                'first_name'                        =>'string',
                'last_name'                         =>'string',
                'company_name'                      =>'string',
                'wat_number'                        =>'string',
                'address'                           =>'string',
                'city'                              =>'string',
                'state'                             =>'string',
                'country'                           =>'string',
                'pin_code'                          =>'string',
                'delivery_date'                     =>'date|after_or_equal:today',
                'landmark'                          =>'nullable|string',
                'phone'                             =>'numeric|digits_between:9,12',
                'email'                             =>'email',
            ]);
            if ($validate->fails()) {
                # code...
                return redirect()->back()->withErrors($validate)->withInput();
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
                    'delivery_date' =>$request->delivery_date,
                    'city'          =>$request->city,
                    'state'         =>$request->state,
                    'country'       =>$request->country,
                    'pin_code'      =>$request->pin_code,
                    'phone'         =>$request->phone,
                    'email'         =>$request->email,
                    'status'        =>$request->status
                ];
                $updateOrder=$this->orderServices->updateOrder($order_id,$data);
                if ($updateOrder['success']) {
                    return redirect('/admin/orders')->with('success', $updateOrder['message']);
                }
                return redirect()->back()->with('error', $updateOrder['message'])->withInput();
            }
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
         }
    }

    // Delete Order
    public function delete($order_id){
        try {
            //code...
            $deleteOrder = $this->orderServices->deleteOrder($order_id);

            if (!empty($deleteOrder['success']) && $deleteOrder['success'] === true) {
                return redirect()->back()->with('success', $deleteOrder['message'] ?? 'Order deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteOrder['message'] ?? 'Failed to delete Order.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Order Details
    public function view($order_id){
        try {
            //code...
            $order=$this->orderServices->ViewOrder($order_id);
            $company=$this->companyServices->getCompanyData();
            $success = $order['success'] ?? false;
            $message = $order['message'] ?? '';
            $data    = $order['data'] ?? [];
            $companyData = $company['data'] ?? [];
            return view('Admin.order-view', compact('success', 'message', 'data','companyData','order_id'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Generate And Download Invoice
    public function invoice($order_id){
        try {
            //code...
            $order=$this->orderServices->ViewOrder($order_id);
            $company=$this->companyServices->getCompanyData();
            $success = $order['success'] ?? false;
            $message = $order['message'] ?? '';
            $data    = $order['data'] ?? [];
            $companyData = $company['data'] ?? [];
           
            $pdf = Pdf::loadView('Admin.pdf.invoice', compact('data','companyData'));

            return $pdf->download('bill-'.$data->order_number.'.pdf');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
}
