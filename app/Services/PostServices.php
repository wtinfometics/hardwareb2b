<?php

namespace App\Services;

use App\Models\post;
use Illuminate\Support\Facades\File;

use App\Services\PostMetaServices;

class PostServices {
    protected $postmetaService;

    // Inject Attribute Image service using constructor
    public function __construct(PostMetaServices $postmetaService){
        $this->postmetaService = $postmetaService;
    }

    // Add New Post
    public function addPost($data,$metadata){
        $addPost=post::create($data);
        if (!$addPost) {
            # if Post Not Added
            return [
                'success'=>false,
                'message'=>'Post Not Added',
                'status'=>400
            ];
        } else {
            # if Post is Added
            $id=$addPost->post_id;
            $addPostmeta=$this->postmetaService->addPostMetaData($id,$metadata);
            if (!$addPostmeta['success']) {
                # If Post meta Data Not Added 
                return $addPostmeta;
            }
            return [
                'success'=>true,
                'message'=>'Post Added Successfully',
                'status'=>200
            ];
        }
    }

    // get All Posts
    public function getAllPost(){
        $posts=post::latest()->get();
        if (!$posts->count()>0) {
            # if Post Not Exists
            return [
                'success'=>false,
                'message'=>'Post Table is Empty',
                'status'=>400
            ];
        } else {
            # if Post Exists
            return [
                'success'=>true,
                'data'=>$posts,
                'status'=>200
            ];
        }
    }

    // Get All Posts with categories
    public function getAllPostWithCategories(){
        $posts=post::with('category')->get();
        if (!$posts->count()>0) {
            # if Post Not Exists
            return [
                'success'=>false,
                'message'=>'Post Table is Empty',
                'status'=>400
            ];
        } else {
            # if Post Exists
            return [
                'success'=>true,
                'data'=>$posts,
                'status'=>200
            ];
        }
    }

    // get Product Details With  Category and Meta dat
    public function getPostDetails($id){
        $post=post::with(['category','meta'])->findOrFail($id);
        if (!$post) {
            # If Post Data Exists
            return[
                'success'=>false,
                'message'=>'Post data Not  Exists',
                'status'=>404
            ];
        } else {
            # If Post Data Exists
            return[
                'success'=>true,
                'data'=>$post,
                'status'=>200
            ];
        }
    }

    // Get Post
    public function getPost($id){
        return $this->checkPost($id);
    }

    // Update Post
    public function updatePost($id,$data,$metadata){
        $post=$this->checkPost($id);
        if (!$post['success']) {
            # if Post Not Exists
            return $post;
        }
        $postData=$post['data'];
        // check Image Exists
        if (isset($data['featured_image'])) {
            # If Post Image exists
            $image=$postData->featured_image;
            $this->deletePostImage($image);  # delete Post Image 
        }
        $updatePost=$postData->update($data);
        if (!$updatePost) {
            # If Post Updated
            return [
                'success'=>false,
                'message'=>'Post Not Updated',
                'status'=>400
            ];
        } else {
            $addPostmeta=$this->postmetaService->addPostMetaData($id,$metadata);
            if (!$addPostmeta['success']) {
                # If Post meta Data Not Added 
                return $addPostmeta;
            }
            # If Post Updated Successfully
            return [
                'success'=>true,
                'message'=>'Post Updated Successfully',
                'status'=>200
            ];
        }
    }

    // Delete Post
    public function deletePost($id){
        $post=$this->checkPost($id);
        if (!$post['success']) {
            # if Post Not Exists
            return $post;
        }
        $postData=$post['data'];
        $image=$postData->featured_image;
        $this->deletePostImage($image);  # delete Post Image 
        $this->postmetaService->deletePostMeta($id);
        $deletePost=$postData->delete();
        if (!$deletePost) {
            # If Post Deleted
            return [
                'success'=>false,
                'message'=>'Post Not Deleted',
                'status'=>400
            ];
        } else {
            # If Post Deleted Successfully
            return [
                'success'=>true,
                'message'=>'Post Deleted Successfully',
                'status'=>200
            ];
        }
    }

    // Check Post By Id
    public function checkPost($id){
        $post=post::find($id);
        if (!$post) {
            # If Post Not Exists
            return [
                'success'=>false,
                'message'=>'Post Not Exists',
                'status'=>400
            ];
        } else {
            # If Post Exists
            $metadata=$this->postmetaService->getPostMetaData($id);
            if (!$metadata['success']) {
                # code...
                return $metadata;
            }
            return [
                'success'=>true,
                'data'=>$post,
                'metadata'=>$metadata['data'],
                'status'=>200
            ];
        }
    }

    // Delete Post Image By Post Id
    public function deletePostImage($imageName){
        $path = public_path('Posts/' . $imageName);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    // get All Active Posts
    public function getAllActivePost(){
        $posts=post::with('category')->where('status',1)->latest()->get();
        if (!$posts->count()>0) {
            # if Post Not Exists
            return [
                'success'=>false,
                'message'=>'Post Table is Empty',
                'status'=>400
            ];
        } else {
            # if Post Exists
            return [
                'success'=>true,
                'data'=>$posts,
                'status'=>200
            ];
        }
    }
}