<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

use App\Services\AdminServices;

class AdminController extends Controller
{

    protected $adminService;

    // Inject Attribute Image service using constructor
    public function __construct(AdminServices $adminService){
        $this->adminService = $adminService;
    }

    // Register Admin
    public function registerAdmin(Request $request){
        try {
            //code...
             $validate=Validator::make($request->all(),[
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'email'=>'required|email',
                'mobile_number'=>'required|numeric|digits_between:9,12',
                'password'=>[
                                'required',
                                'string',
                                'min:8',
                                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                            ],
                'passwordConform'=>'required|same:password',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $encPassword = $this->encryptPassword($request->password);

            $data=[
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'mobile_number'=>$request->mobile_number,
                'password'=>$encPassword,
            ];

            $registerAdmin = $this->adminService->registerAdmin($data);
            $message=$registerAdmin['message'];
            if ($registerAdmin['success']) {
                return redirect('/login')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Admin
    public function viewAdmin(){
        try {
            //code...
            // $adminId=Session::get('admin_auth.admin_id');
            $adminId=1;
            $banner = $this->adminService->checkAdmin($adminId,null);
            $success = $banner['success'] ?? false;
            $message = $banner['message'] ?? '';
            $data    = $banner['data'] ?? [];
            return view('Admin.profile', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Admin
    public function updateAdmin(request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'email'=>'required|email',
                'mobile_number'=>'required|numeric|digits_between:9,12',
            ]);
            if ($validate->fails()) {
                # if Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # if Validation Fails
                $data=[
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                    'mobile_number'=>$request->mobile_number,
                ];    
                $adminId=Session::get('admin_auth.admin_id');
                $updateAdmin = $this->adminService->updateAdmin($adminId,$data);
                $message=$updateAdmin['message'];
                if ($updateAdmin['success']) {
                    return back()->with('success', $message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Password
    public function updatePassword(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
            'password'=>[
                            'required',
                            'string',
                            'min:8',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                        ],
            'passwordConform'=>'required|same:password',
        ]);
        if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $encPassword = $this->encryptPassword($request->password);
            $data=[
                'password'=>$encPassword,
            ];
            $adminId=Session::get('admin_auth.admin_id');
            $updatePassword = $this->adminService->updateAdmin($adminId,$data);
            $message=$updatePassword['message'];
            if ($updatePassword['success']) {
                Auth::guard('admin')->logout();
                Session::forget('admin_auth');
                return redirect('/login')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        
    }

    // login Admin
    public function logIn(Request $request){
        try {
            //code...
             $validate=Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $data=[
                'email'=>$request->email,
                'password'=>$request->password,
            ];
            $loginAdmin = $this->adminService->login($data);
            $message=$loginAdmin['message'];
            if ($loginAdmin['success']) {
                return redirect('/admin/dashboard')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // logout  Admin
    public function logOut(){
        try {
            //code...
            $logOutAdmin = $this->adminService->logout();
            $message=$logOutAdmin['message'];
            if ($logOutAdmin['success']) {
                return redirect('/login')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Forget Password
    public function forgetPassword(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'email'=>'required|email'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $forgetPassword = $this->adminService->forgetPassword($request->email);
            $message=$forgetPassword['message'];
            if ($forgetPassword['success']) {
                return redirect('/verify')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Verify OTP
    public function verifyOTP(Request $request){
        try {
            //code...
           $validate=Validator::make($request->all(),[
                'otp'=>'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $encPassword = $this->encryptPassword($request->password);
            $email=Session::get('reset.email');
            $data=[
                'email'=>$email,
                'otp'=>$request->otp,
            ]; 
            $verifyOTP = $this->adminService->verifyOTP($data);
            $message=$verifyOTP['message'];
            if ($verifyOTP['success']) {
                return redirect('/reset')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Reset Password
    public function resetPassword(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'password'=>[
                                'required',
                                'string',
                                'min:8',
                                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                            ],
                'passwordConform'=>'required|same:password',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $encPassword = $this->encryptPassword($request->password);
            $email=Session::get('reset.email');
            $data=[
                'email'=>$email,
                'password'=>$encPassword,
            ];
            $resetPassword = $this->adminService->resetPassword($data);
            $message=$resetPassword['message'];
            if ($resetPassword['success']) {
                return redirect('/login')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
 
      // Generate  Encrypted password
    protected function encryptPassword($password){
        return Hash::make($password);
    }
}
