<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\AttributeVariationServices;
use App\Helpers\PaginationHelper;
class AttributeVariationController extends Controller
{
     protected $attributeVariationServices;

    // Inject Attribute Image service using constructor
    public function __construct(AttributeVariationServices $attributeVariationServices){
        $this->attributeVariationServices = $attributeVariationServices;
    }

    // Add Attribute Variation
    public function store(Request $request,$attribute_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'attribute_variation_name'=>'required|string',
            ]);
            if ($validate->fails()) {
                # If Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation Fails
                $data=[
                    'attribute_variation_name'=>$request->attribute_variation_name,
                    'attribute_id'=>$attribute_id
                    ];
                $saveAttribute=$this->attributeVariationServices->addAttributeVariation($data);   # Save The Attribute
                $message=$saveAttribute['message'];
                if ($saveAttribute['success']) {
                    return redirect('/admin/attributes/'.$attribute_id.'/variations')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getTraceAsString());
        }
    }

    // Index Add Attributes
    public function indexAddAttributeVariation($attribute_id){
        return view('Admin.attribute-variation-create',compact('attribute_id'));
    }

    // View Attribute Variation By Attribute
    public function index($attribute_id){
        try {
            //code...
            $attributes = $this->attributeVariationServices->GetAllAttributeVariationByAttribute($attribute_id);
            $success = $attributes['success'] ?? false;
            $message = $attributes['message'] ?? '';
            $data    = $attributes['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.attribute-variations', compact('success', 'message', 'paginatedData','attribute_id'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getTraceAsString());
        }
    }

    // View Attribute
    public function edit($attribute_id,$attribute_variation_id){
        try {
            //code...
            $attributes = $this->attributeVariationServices->getAttributeVariation($attribute_variation_id);
            $success = $attributes['success'] ?? false;
            $message = $attributes['message'] ?? '';
            $data    = $attributes['data'] ?? [];
            return view('Admin.attribute-variation-create', compact('success', 'message', 'data','attribute_id'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getTraceAsString());
        }
    }

    // Update Attribute
    public function update(Request $request,$attribute_id,$attribute_variation_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'attribute_variation_name'=>'required|string',
            ]);
            if ($validate->fails()) {
                # If Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation Fails
                $data=['attribute_variation_name'=>$request->attribute_variation_name];
                $updateAttributeVariation=$this->attributeVariationServices->updateAttributeVariation($attribute_variation_id,$data);   # Save The Attribute
                $message=$updateAttributeVariation['message'];
                if ($updateAttributeVariation['success']) {
                    return redirect('/admin/attributes/'.$attribute_id.'/variations')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Something went wrong, please try again!');
        }
    }

    // Delete Attribute
    public function delete($attribute_id,$attribute_variation_id){
        try {
            //code...
            $deleteAttributeVariation = $this->attributeVariationServices->deleteAttributeVariation($attribute_variation_id);
            $success = $deleteAttributeVariation['success'] ?? false;
            $message = $deleteAttributeVariation['message'] ?? '';
            if ($success) {
                    return redirect('/admin/attributes/'.$attribute_id.'/variations')->with('success',$message);
                } else {
                    return redirect()->back()->with('error',$message)->withInput();
                }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Something went wrong, please try again!');
        }
    }
    
}
