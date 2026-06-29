<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\ContactServices;
use App\Helpers\PaginationHelper;

class ContactController extends Controller
{
    //
    protected $contactServices;

    // Inject Attribute Image service using constructor
    public function __construct(ContactServices $contactServices){
        $this->contactServices = $contactServices;
    }

    // Create Contact
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'phone'=>'required|numeric|digits_between:9,12',
                'email'=>'required|email',
                'subject'=>'required|string',
                'message'=>'required|string'
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $data = [
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'subject'=>$request->subject,
                    'message'=>$request->message,
                ];
                $saveContact = $this->contactServices->addContact($data);
                if ($saveContact['success']) {
                    return redirect('/contact')->with('success', $saveContact['message']);
                }
                return redirect()->back()->with('error', $saveContact['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View All contacts
    public function index(){
        try {
            //code...
            $contacts=$this->contactServices->getAllContacts();
            $success = $contacts['success'] ?? false;
            $message = $contacts['message'] ?? '';
            $data    = $contacts['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.contacts', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Contact
    public function view($contact_id){
        try {
            //code...
            $contact=$this->contactServices->getContact($contact_id);
            $success = $contact['success'] ?? false;
            $message = $contact['message'] ?? '';
            $data    = $contact['data'] ?? [];
            return view('Admin.contact-view', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

       // Delete Contact
    public function delete($contact_id){
        try {
            //code...
            $deleteContact = $this->contactServices->deleteContact($contact_id);

            if (!empty($deleteContact['success']) && $deleteContact['success'] === true) {
                return redirect()->back()->with('success', $deleteContact['message'] ?? 'Contact Message deleted successfully!');
            }
            return redirect()->back()->with('error', $deleteContact['message'] ?? 'Failed to delete Contact Message.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
}
