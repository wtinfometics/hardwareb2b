<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\AttributeServices;
use App\Helpers\PaginationHelper;

class AttributeController extends Controller
{
        protected $attributeServices;

    // Inject Attribute Image service using constructor
    public function __construct(AttributeServices $attributeServices){
        $this->attributeServices = $attributeServices;
    }

    // Create Attribute
    public function store(Request $request){
        try {
            $validate = Validator::make($request->all(), [
                'attribute_name' => 'required|string'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $data = ['attribute_name' => $request->attribute_name];

            $saveAttribute = $this->attributeServices->addAttribute($data);
            $message=$saveAttribute['message'];
            if ($saveAttribute['success']) {
                return redirect('/admin/attributes')->with('success',$message);
            } else {
                return redirect()->back()->with('error',$message)->withInput();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }

    // View Attributes
    public function index(){
        try {
            $attributes = $this->attributeServices->getAllAttribute();
            $success = $attributes['success'] ?? false;
            $message = $attributes['message'] ?? '';
            $data    = $attributes['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.attributes', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }

    // Index Add Attributes
    public function indexAddAttribute(){
        return view('Admin.attribute-create');
    }

    // View Attribute
    public function edit($attribute_id){
        try {
            $attributes = $this->attributeServices->getAttribute($attribute_id);
            $success = $attributes['success'] ?? false;
            $message = $attributes['message'] ?? '';
            $data    = $attributes['data'] ?? [];
            return view('Admin.attribute-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }

    // Update Attribute
    public function update(Request $request,$attribute_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'attribute_name'=>'required|string'
            ]);
            if ($validate->fails()) {
                # If Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation Fails
                $data=['attribute_name'=>$request->attribute_name];
                $updateAttribute=$this->attributeServices->updateAttribute($attribute_id,$data);   # Save The Attribute
                $message=$updateAttribute['message'];
                 if ($updateAttribute['success']) {
                    return redirect('/admin/attributes')->with('success',$message);
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
    public function delete($attribute_id)
    {
        try {
            $response = $this->attributeServices->deleteAttribute($attribute_id);

            if (!empty($response['success']) && $response['success'] === true) {
                return redirect()->back()
                    ->with('success', $response['message'] ?? 'Attribute deleted successfully!');
            }

            return redirect()->back()
                ->with('error', $response['message'] ?? 'Failed to delete attribute.');

        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again!');
        }
    }
}
