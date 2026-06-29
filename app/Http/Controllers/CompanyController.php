<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\CompanyServices;

class CompanyController extends Controller
{
    protected $companyServices;

    // Inject Attribute Image service using constructor
    public function __construct(CompanyServices $companyServices){
        $this->companyServices = $companyServices;
    }

    // Create Or Update Company data
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'name'=>'required|string',
                'website_name'=>'required|string',
                'website_url'=>'required|url',
                'trn_number'=>'required|string',
                'address'=>'required|string',
                'street'=>'required|string',
                'city'=>'required|string',
                'state'=>'required|string',
                'country'=>'required|string',
                'pin_code'=>'required|numeric',
                'phone' => 'required|numeric|digits_between:9,12',
                'email'=>'required|email',
                'logo'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:500|dimensions:width=200,height=72',
                'fav_icon'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:80|dimensions:width=50,height=50',
            ]); 
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $data = [
                    'name'=>$request->name,
                    'website_name'=>$request->website_name,
                    'website_url'=>$request->website_url,
                    'trn_number'=>$request->trn_number,
                    'address'=>$request->address,
                    'street'=>$request->street,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'country'=>$request->country,
                    'pin_code'=>$request->pin_code,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                ];

                // File upload Logo
                 if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $fileName = time() . '_'.'Logo_' . $request->name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Company'), $fileName);
                    $data['logo'] = $fileName;
                 }

                 // File upload Fav Icon
                 if ($request->hasFile('fav_icon')) {
                    $file = $request->file('fav_icon');
                    $fileName = time() . '_'.'FavIcon_'  . $request->name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Company'), $fileName);
                    $data['fav_icon'] = $fileName;
                 }

                $savePolicy = $this->companyServices->storeCompanyData($data);
                if ($savePolicy['success']) {
                    return redirect('/admin/company')->with('success', $savePolicy['message']);
                }
                return redirect()->back()->with('error', $savePolicy['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Company data
    public function index(){
        try {
            //code...
            $companyData=$this->companyServices->getCompanyData();
            $success = $companyData['success'] ?? false;
            $message = $companyData['message'] ?? '';
            $data    = $companyData['data'] ?? [];
            return view('Admin.company', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
