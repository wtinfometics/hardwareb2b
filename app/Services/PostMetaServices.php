<?php

namespace App\Services;

use App\Models\postmeta;

class PostMetaServices {

    // Add And Update Post Meta
    public function addPostMetaData($id,$data){
        $insertPostMeta = postmeta::updateOrCreate(
            ['post_id' => $id], // condition
            $data // values to update or insert
        );
        if (!$insertPostMeta) {
            # If Post Meta Data Not inserted
            return [
                'success'=>false,
                'message'=>'Post Meta Data Not Inserted',
                'status'=>400
            ];
        } else {
            # If Post Meta Data inserted
            return [
                'success'=>true,
                'message'=>'Post Meta Data is Inserted',
                'status'=>200
            ];
        }
    }

    // Get Post Meta
    public function getPostMetaData($post_id){
        $postMeta=postmeta::where('post_id',$post_id)->first();
        if ( !$postMeta) {
            # If Post meta Exists
            return [
                'success'=>false,
                'message'=>'Post meta Not exists',
                'status'=>400
            ];
        } else {
            # If Post meta Exists
            return [
                'success'=>true,
                'data'=>$postMeta,
                'status'=>200
            ];
        }
    }

    // Delete Post Meta
    public function deletePostMeta($post_id){
        $deletePostMeta=postmeta::where('post_id',$post_id)->delete();
        if (!$deletePostMeta) {
            # if Post meta data Not Deleted 
            return [
                'success'=>false,
                'message'=>'Post Meta Data is Deleted',
                'status'=>400
            ];
        } else {
            # if Post meta data is Deleted 
            return [
                'success'=>false,
                'message'=>'Post Meta Data is Deleted Successfully',
                'status'=>400
            ];
        }
    }

}