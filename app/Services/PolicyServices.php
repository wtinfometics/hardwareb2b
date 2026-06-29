<?php

namespace App\Services;

use App\Models\policy;

class PolicyServices {

     // Add New Policy
    public function addPolicy($data){
        $addPolicy=policy::create($data);
        if (!$addPolicy) {
            # if Policy Not Added
            return [
                'success'=>false,
                'message'=>'Policy Not Added',
                'status'=>400
            ];
        } else {
            # if Policy is Added
            return [
                'success'=>true,
                'message'=>'Policy Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Policies
    public function getAllPolicies(){
        $policies=policy::latest()->get();
        if (!$policies->count()>0) {
            # if Policy Not Exists
            return [
                'success'=>false,
                'message'=>'Policy Table is Empty',
                'status'=>400
            ];
        } else {
            # if Policy Exists
            return [
                'success'=>true,
                'data'=>$policies,
                'status'=>200
            ];
        }
    }

    // Get Policy
    public function getPolicy($id){
        return $this->checkPolicy($id);
    }

    // Update Policy
    public function updatePolicy($id,$data){
        $policy=$this->checkPolicy($id);
        if (!$policy['success']) {
            # if Policy Not Exists
            return $policy;
        }
        $policyData=$policy['data'];
        $updatePolicy=$policyData->update($data);
        if (!$updatePolicy) {
            # If Policy Updated
            return [
                'success'=>false,
                'message'=>'Policy Not Updated',
                'status'=>400
            ];
        } else {
            # If Policy Updated Successfully
            return [
                'success'=>true,
                'message'=>'Policy Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Policy
    public function deletePolicy($id){
        $policy=$this->checkPolicy($id);
        if (!$policy['success']) {
            # if Policy Not Exists
            return $policy;
        }
        $policyData=$policy['data'];
        $deletePolicy=$policyData->delete();
        if (!$deletePolicy) {
            # If Policy Deleted
            return [
                'success'=>false,
                'message'=>'Policy Not Deleted',
                'status'=>400
            ];
        } else {
            # If Policy Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Policy Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Policy By Id
    public function checkPolicy($id){
        $policy=policy::find($id);
        if (!$policy) {
            # If Policy Not Exists
            return [
                'success'=>false,
                'message'=>'Policy Not Exists',
                'status'=>400
            ];
        } else {
            # If Policy Exists
            return [
                'success'=>true,
                'data'=>$policy,
                'status'=>200
            ];
        }
    }

    // Get All Active Policies
    public function getAllActivePolicies(){
        $policies=policy::where('status',1)->latest()->get();
        if (!$policies->count()>0) {
            # if Policy Not Exists
            return [
                'success'=>false,
                'message'=>'Policy Table is Empty',
                'status'=>400
            ];
        } else {
            # if Policy Exists
            return [
                'success'=>true,
                'data'=>$policies,
                'status'=>200
            ];
        }
    }
}