<?php

namespace App\Services;

use App\Models\attributevariation;

class AttributeVariationServices {

    // Add New Attribute Variation
    public function addAttributeVariation($data){
        $addAttributeVariation=attributevariation::create($data);
        if (!$addAttributeVariation) {
            # if Attribute Variation Not Added
            return [
                'success'=>false,
                'message'=>'Attribute Variation Not Added',
                'status'=>400
            ];
        } else {
            # if Attribute Variation is Added
            return [
                'success'=>true,
                'message'=>'Attribute Variation Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Attribute Variations
    public function GetAllAttributeVariationByAttribute($attribute_id){
        $attributeVariations=attributevariation::where('attribute_id',$attribute_id)->get();
        if (!$attributeVariations->count()>0) {
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
                'data'=>$attributeVariations,
                'status'=>200
            ];
        }
    }

    // Get Attribute Variation
    public function getAttributeVariation($id){
        return $this->checkAttributeVariation($id);
    }

    // Update Attribute Variation
    public function updateAttributeVariation($id,$data){
        $attributeVariation=$this->checkAttributeVariation($id);
        if (!$attributeVariation['success']) {
            # if attribute Not Exists
            return $attributeVariation;
        }
        $attributeVariationData=$attributeVariation['data'];
        $updateAttributeVariation=$attributeVariationData->update($data);
        if (!$updateAttributeVariation) {
            # If Attribute Variation Updated
            return [
                'success'=>false,
                'message'=>'Attribute Variation Not Updated',
                'status'=>400
            ];
        } else {
            # If Attribute Variation Updated Successfully
            return [
                'success'=>true,
                'message'=>'Attribute Variation Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Attribute Variation
    public function deleteAttributeVariation($id){
        $attributeVariation=$this->checkAttributeVariation($id);
        if (!$attributeVariation['success']) {
            # if attribute Not Exists
            return $attributeVariation;
        }
        $attributeVariationData=$attributeVariation['data'];
        $deleteAttributeVariation=$attributeVariationData->delete();
        if (!$deleteAttributeVariation) {
            # If Attribute Variation Deleted
            return [
                'success'=>false,
                'message'=>'Attribute Variation Not Deleted',
                'status'=>400
            ];
        } else {
            # If Attribute Variation Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Attribute Variation Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Attribute Variation By Id
    public function checkAttributeVariation($id){
        $attributeVariation=attributevariation::find($id);
        if (!$attributeVariation) {
            # If Attribute Variation Not Exists
            return [
                'success'=>false,
                'message'=>'Attribute Variation Not Exists',
                'status'=>400
            ];
        } else {
            # If Attribute Variation Exists
            return [
                'success'=>true,
                'data'=>$attributeVariation,
                'status'=>200
            ];
        }
    }
}