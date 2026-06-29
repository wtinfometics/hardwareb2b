<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\PosterServices;
use App\Helpers\PaginationHelper;

class PosterController extends Controller
{
    //
     protected $posterService;

    // Inject Attribute Image service using constructor
    public function __construct(PosterServices $posterService){
        $this->posterService = $posterService;
    }

    // index add Brand 
    public function indexAddPoster(){
        return view('Admin.poster-create');
    }

    // Create Banner
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'poster_name'=>'required|string',
                "poster_image"=>'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=600,height=360',
                'poster_header'=>'required|string',
                'featured_message'=>'required|string',
                'link'=>'url',
                'button_text'=>'string',
                'status'=>'boolean'
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                // File upload
                $file = $request->file('poster_image');
                $fileName = time() . '_' . $request->poster_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Posters'), $fileName);

                $data = [
                    'poster_name'   =>$request->poster_name ,
                    'poster_image' =>$fileName,
                    'poster_header'=>$request->poster_header,
                    'featured_message'=>$request->featured_message,
                    'link'=>$request->link,
                    'button_text'=>$request->button_text,
                    'status'=>$request->status
                ];
                $savePoster = $this->posterService->addPoster($data);
                if ($savePoster['success']) {
                    return redirect('/admin/posters')->with('success', $savePoster['message']);
                }
                return redirect()->back()->with('error', $savePoster['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }


    // View All Banner
    public function index(){
        try {
            //code...
            $posters=$this->posterService->getAllPoster();
            $success = $posters['success'] ?? false;
            $message = $posters['message'] ?? '';
            $data    = $posters['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.posters', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Banner
    public function edit($poster_id){
        try {
            //code...
            $poster = $this->posterService->getPoster($poster_id);
            $success = $poster['success'] ?? false;
            $message = $poster['message'] ?? '';
            $data    = $poster['data'] ?? [];
            return view('Admin.poster-create', compact('success', 'message', 'data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Banner
    public function update(Request $request,$poster_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'poster_name'=>'required|string',
                "poster_image"=>'image|mimes:jpg,jpeg,png,webp|max:800|dimensions:width=600,height=360',
                'poster_header'=>'required|string',
                'featured_message'=>'required|string',
                'link'=>'url',
                'button_text'=>'string',
                'status'=>'required|boolean'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                $data = [
                    'poster_name'   =>$request->poster_name ,
                    'poster_header'=>$request->poster_header,
                    'featured_message'=>$request->featured_message,
                    'link'=>$request->link,
                    'button_text'=>$request->button_text,
                    'status'=>$request->status
                ];
                if ($request->hasFile('poster_image')) {
                    $file = $request->file('poster_image');
                    $fileName = time() . '_' . $request->poster_name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Posters'), $fileName);
                    $data['poster_image'] = $fileName;
                }
                $updatePoster = $this->posterService->updatePoster($poster_id,$data);
                $message=$updatePoster['message'];
                if ($updatePoster['success']) {
                    return redirect('/admin/posters')->with('success',$message);
                } else {
                    return redirect()->back()->with('error', $th->getMessage())->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Banner
    public function delete($poster_id){
        try {
            //code...
            $deletePoster = $this->posterService->deletePoster($poster_id);

            if (!empty($deletePoster['success']) && $deletePoster['success'] === true) {
                return redirect()->back()->with('success', $deletePoster['message'] ?? 'Poster deleted successfully!');
            }
            return redirect()->back()->with('error', $deletePoster['message'] ?? 'Failed to delete Poster.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

}
