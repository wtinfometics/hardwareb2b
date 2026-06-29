<?php

namespace App\Services;

use App\Models\poster;
use Illuminate\Support\Facades\File;

class PosterServices {

    // Add New Poster
    public function addPoster($data){
        $addPoster=poster::create($data);
        if (!$addPoster) {
            # if Poster Not Added
            return [
                'success'=>false,
                'message'=>'Poster Not Added',
                'status'=>400
            ];
        } else {
            # if Poster is Added
            return [
                'success'=>true,
                'message'=>'Poster Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Posters
    public function getAllPoster(){
        $posters = poster::latest()->get();
        if (!$posters->count()>0) {
            # if Poster Not Exists
            return [
                'success'=>false,
                'message'=>'Poster Table is Empty',
                'status'=>400
            ];
        } else {
            # if Poster Exists
            return [
                'success'=>true,
                'data'=>$posters,
                'status'=>200
            ];
        }
    }

    // Get Poster
    public function getPoster($id){
        return $this->checkPoster($id);
    }

    // Update Poster
    public function updatePoster($id,$data){
        $poster=$this->checkPoster($id);
        if (!$poster['success']) {
            # if Poster Not Exists
            return $poster;
        }
        $posterData=$poster['data'];
        // check Image Exists
        if (isset($data['poster_image'])) {
            # If Poster Image exists
            $image=$posterData->poster_image;
            $this->deletePosterImage($image);  # delete Poster Image 
        }
        $updatePoster=$posterData->update($data);
        if (!$updatePoster) {
            # If Poster Updated
            return [
                'success'=>false,
                'message'=>'Poster Not Updated',
                'status'=>400
            ];
        } else {
            # If Poster Updated Successfully
            return [
                'success'=>true,
                'message'=>'Poster Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Poster
    public function deletePoster($id){
        $poster=$this->checkPoster($id);
        if (!$poster['success']) {
            # if Poster Not Exists
            return $poster;
        }
        $posterData=$poster['data'];
        $image=$posterData->poster_image;
        $this->deletePosterImage($image);  # delete Poster Image 
        $deletePoster=$posterData->delete();
        if (!$deletePoster) {
            # If Poster Deleted
            return [
                'success'=>false,
                'message'=>'Poster Not Deleted',
                'status'=>400
            ];
        } else {
            # If Poster Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Poster Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Poster By Id
    public function checkPoster($id){
        $poster=poster::find($id);
        if (!$poster) {
            # If Poster Not Exists
            return [
                'success'=>false,
                'message'=>'Poster Not Exists',
                'status'=>400
            ];
        } else {
            # If Poster Exists
            return [
                'success'=>true,
                'data'=>$poster,
                'status'=>200
            ];
        }
    }
    
    // delete Poster Image By Poster Id
    public function deletePosterImage($imageName){
        $path = public_path('Posters/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

     // get All Active Posters
    public function getAllActivePoster(){
        $posters = poster::where('status',1)->latest()->get();
        if (!$posters->count()>0) {
            # if Poster Not Exists
            return [
                'success'=>false,
                'message'=>'Poster Table is Empty',
                'status'=>400
            ];
        } else {
            # if Poster Exists
            return [
                'success'=>true,
                'data'=>$posters,
                'status'=>200
            ];
        }
    }
}