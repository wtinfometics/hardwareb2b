<?php

namespace App\Services;

use App\Models\attribute;

class AttributeServices {

    // Add New Attribute
    public function addAttribute($data){
        $addAttribute=attribute::create($data);
        if (!$addAttribute) {
            # if Attribute Not Added
            return [
                'success'=>false,
                'message'=>'Attribute Not Added',
                'status'=>400
            ];
        } else {
            # if Attribute is Added
            return [
                'success'=>true,
                'message'=>'Attribute Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Attributes
    public function getAllAttribute(){
        $attribute=attribute::latest()->get();
        if (!$attribute->count()>0) {
            # if Attribute Not Exists
            return [
                'success'=>false,
                'message'=>'Attribute Table is Empty',
                'status'=>400
            ];
        } else {
            # if Attribute Exists
            return [
                'success'=>true,
                'data'=>$attribute,
                'status'=>200
            ];
        }
    }

    // Get Attribute
    public function getAttribute($id){
        return $this->checkAttribute($id);
    }

    // Update Attribute
    public function updateAttribute($id,$data){
        $attribute=$this->checkAttribute($id);
        if (!$attribute['success']) {
            # if attribute Not Exists
            return $attribute;
        }
        $attributeData=$attribute['data'];
        $updateAttribute=$attributeData->update($data);
        if (!$updateAttribute) {
            # If Attribute Updated
            return [
                'success'=>false,
                'message'=>'Attribute Not Updated',
                'status'=>400
            ];
        } else {
            # If Attribute Updated Successfully
            return [
                'success'=>true,
                'message'=>'Attribute Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Attribute
    public function deleteAttribute($id){
        $attribute=$this->checkAttribute($id);
        if (!$attribute['success']) {
            # if attribute Not Exists
            return $attribute;
        }
        $attributeData=$attribute['data'];
        $deleteAttribute=$attributeData->delete();
        if (!$deleteAttribute) {
            # If Attribute Deleted
            return [
                'success'=>false,
                'message'=>'Attribute Not Deleted',
                'status'=>400
            ];
        } else {
            # If Attribute Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Attribute Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Attribute By Id
    public function checkAttribute($id){
        $attribute=attribute::find($id);
        if (!$attribute) {
            # If Attribute Not Exists
            return [
                'success'=>false,
                'message'=>'Attribute Not Exists',
                'status'=>400
            ];
        } else {
            # If Attribute Exists
            return [
                'success'=>true,
                'data'=>$attribute,
                'status'=>200
            ];
        }
    }

    // get Attribute With Variation
    public function getAttributeWithVariation(){
        $attributes = attribute::with('variations')->get();
        if (!$attribute->count()>0) {
            # If Attribute Exists
            return [
                'success'=>false,
                'message'=>'Attribute And Variation Not Exists',
                'status'=>400
            ];
        } else {
            # If Attribute Exists
            return [
                'success'=>true,
                'data'=>$attribute,
                'status'=>200
            ];
        }
    }

      // display related attribute and Variation
    public function relatedAttributeVariation(){
        $attributes = attribute::with('attributevariations')->get();
        if (!$attributes->count()>0) {
            # if Attribute Variation Not Exists
            return [
                'success'=>false,
                'message'=>'Attribute Variation Table is Empty',
                'status'=>400
            ];
        } else {
            # if Attribute Variation Exists
            return [
                'success'=>true,
                'data'=>$attributes,
                'status'=>200
            ];
        }
    }
}