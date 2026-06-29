<?php

namespace App\Services;

use App\Models\socialmedia;

class SocialMediaServices {
    
    // Add And Update Social media
    public function addSocialMedia( $data){
        // Get first record or create new instance
        $socialMedia = socialmedia::firstOrNew();
        // Fill data
        $socialMedia->fill($data);
        // Save record
        $saveSocialAccount=$socialMedia->save();
        if (!$saveSocialAccount) {
            return [
                'success' => false,
                'message' => 'Social Media Account not saved.',
                'status'  => 400
            ];
        }
         return [
                'success' => true,
                'message' => 'Social Media Account saved successfully.',
                'status'  => 200,
                'data'    => $socialMedia
            ];
    }

    // Get social Media Account
    public function getSocialMediaAccount(){
        $socialMediaAccount=socialmedia::first();
        if (!$socialMediaAccount) {
            # If Social Media Data Not Exists
            return [
                'success'=>false,
                'message'=>'Social Media Account Not Exists',
                'status'=>400
            ];
        } else {
            # If Social Media Data Exists
            return [
                'success'=>true,
                'data'=>$socialMediaAccount,
                'status'=>200
            ];
        }
    }
}