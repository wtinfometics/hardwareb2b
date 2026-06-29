<?php

namespace App\Services;

use App\Models\contact;

class ContactServices {

        // Add New Contact
    public function addContact($data){
        $addContact=contact::create($data);
        if (!$addContact) {
            # if Contact Not Added
            return [
                'success'=>false,
                'message'=>'Contact Not Added',
                'status'=>400
            ];
        } else {
            # if Contact is Added
            return [
                'success'=>true,
                'message'=>'Contact Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Contact
    public function getAllContacts(){
        $contacts=contact::latest()->get();
        if (!$contacts->count()>0) {
            # if Contacts Not Exists
            return [
                'success'=>false,
                'message'=>'Contacts Table is Empty',
                'status'=>400
            ];
        } else {
            # if Contacts Exists
            return [
                'success'=>true,
                'data'=>$contacts,
                'status'=>200
            ];
        }
    }

    // Get Contact
    public function getContact($id){
        return $this->checkContact($id);
    }

    // Delete Contact
    public function deleteContact($id){
        $contact=$this->checkContact($id);
        if (!$contact['success']) {
            # if Contact Not Exists
            return $contact;
        }
        $contactData=$contact['data'];
        $deleteContact=$contactData->delete();
        if (!$deleteContact) {
            # If Contact Deleted
            return [
                'success'=>false,
                'message'=>'Contact Not Deleted',
                'status'=>400
            ];
        } else {
            # If Contact Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Contact Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Contact
    public function checkContact($id){
        $contact=contact::find($id);
        if (!$contact) {
            # If Contact Not Exists
            return [
                'success'=>false,
                'message'=>'Contact Not Exists',
                'status'=>400
            ];
        } else {
            # If Contact Exists
            return [
                'success'=>true,
                'data'=>$contact,
                'status'=>200
            ];
        }
    }
    
}