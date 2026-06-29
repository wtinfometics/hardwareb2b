<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\PolicyServices;
use App\Helpers\PaginationHelper;

class PolicyController extends Controller
{
    protected $policyServices;

    // Inject Attribute Image service using constructor
    public function __construct(PolicyServices $policyServices){
        $this->policyServices = $policyServices;
    }

    // index Add Policy Page
    public function indexAddPolicy(){
        return view('Admin.policy-create');
    }

    // Create policy
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'policy_name'=>'required|string',
                'description'=>'required|string',
                'status'=>'boolean',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $slug = \Str::slug($request->policy_name);
                $data = [
                    'policy_name'   =>$request->policy_name ,
                    'description'   =>$request->description,
                    'status'        =>$request->status ?? '' ,
                    'slug'          =>$slug,
                ];
                $savePolicy = $this->policyServices->addPolicy($data);
                if ($savePolicy['success']) {
                    return redirect('/admin/policies')->with('success', $savePolicy['message']);
                }
                return redirect()->back()->with('error', $savePolicy['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All Policies
    public function index(){
        try {
            //code...
            $policies=$this->policyServices->getAllPolicies();
            $success = $policies['success'] ?? false;
            $message = $policies['message'] ?? '';
            $data    = $policies['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.policies', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Policy
    public function edit($policy_id){
        try {
            //code...
            $policy=$this->policyServices->getPolicy($policy_id);
            $success = $policy['success'] ?? false;
            $message = $policy['message'] ?? '';
            $data    = $policy['data'] ?? [];
            return view('Admin.policy-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Policy
    public function update(Request $request,$policy_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'policy_name'=>'required|string',
                'description'=>'required|string',
                'status'=>'boolean',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $slug = \Str::slug($request->policy_name);
                $data = [
                    'policy_name'   =>$request->policy_name ,
                    'description'   =>$request->description,
                    'status'        =>$request->status ?? '' ,
                    'slug'          =>$slug,
                ];
                $updatePolicy = $this->policyServices->updatePolicy($policy_id,$data);
                if ($updatePolicy['success']) {
                    return redirect('/admin/policies')->with('success', $updatePolicy['message']);
                }
                return redirect()->back()->with('error', $updatePolicy['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Policy
    public function delete($policy_id){
        try {
            //code...
            $deletePolicy = $this->policyServices->deletePolicy($policy_id);

            if (!empty($deletePolicy['success']) && $deletePolicy['success'] === true) {
                return redirect()->back()->with('success', $deletePolicy['message'] ?? 'Category deleted successfully!');
            }
            return redirect()->back()->with('error', $deletePolicy['message'] ?? 'Failed to delete Category.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Policy
    public function view($policy_id){
        try {
            //code...
            $policy=$this->policyServices->getPolicy($policy_id);
            $success = $policy['success'] ?? false;
            $message = $policy['message'] ?? '';
            $data    = $policy['data'] ?? [];
            return view('User.policy-details', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
