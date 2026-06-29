<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\SocialMediaServices;

class SocialMediaController extends Controller
{
    protected $socialMediaServices;

    // Inject Attribute Image service using constructor
    public function __construct(SocialMediaServices $socialMediaServices){
        $this->socialMediaServices = $socialMediaServices;
    }

    // Create Or Update Social Media Account
    public function store(Request $request){
        try {
            //code...
             $validate = Validator::make($request->all(), [
                'facebook'  => 'nullable|url',
                'instagram' => 'nullable|url',
                'x'         => 'nullable|url',
                'linkedin'  => 'nullable|url',
                'youtube'   => 'nullable|url',
                'whatsapp' => 'nullable|url',
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                $data = [
                    'facebook'=>$request->facebook,
                    'instagram'=>$request->instagram,
                    'x'=>$request->x,
                    'linkedin'=>$request->linkedin,
                    'youtube'=>$request->youtube,
                    'whatsapp'=>$request->whatsapp,
                ];
                $saveSocialMedia = $this->socialMediaServices->addSocialMedia($data);
                if ($saveSocialMedia['success']) {
                    return redirect()->back()->with('success', $saveSocialMedia['message']);
                }
                return redirect()->back()->with('error', $saveSocialMedia['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Social media Data
    public function index(){
        try {
            //code...
            $socialMedia=$this->socialMediaServices->getSocialMediaAccount();
            $success = $socialMedia['success'] ?? false;
            $message = $socialMedia['message'] ?? '';
            $data    = $socialMedia['data'] ?? [];
            return view('Admin.social-media', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
