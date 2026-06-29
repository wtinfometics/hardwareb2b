<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use App\Services\PostServices;
use App\Services\CategoryServices;
use App\Helpers\PaginationHelper;

class PostController extends Controller
{

    protected $postService;
    protected $categoryServices;

    // Inject Attribute Image service using constructor
    public function __construct(PostServices $postService,CategoryServices $categoryServices){
        $this->postService = $postService;
        $this->categoryServices = $categoryServices;
    }

    // index add Post 
    public function indexAddPost(){
        $categories = $this->categoryServices->GetAllCategory();

        return view('Admin.post-create', [
            'success' => $categories['success'] ?? false,
            'catMessage' => $categories['message'] ?? '',
            'allCategories' => $categories['data'] ?? [],
        ]); 
    }

    // Create Post
    public function store(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'post_name'=>'required|string',
                'category_id'=>'required|exists:categories,category_id',
                'short_description'=>'required|string',
                'description'=>'required|string',
                'featured_image'=>'required|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=800,height=500',
                'meta_title'=>'required|string',
                'meta_description'=>'required|string',
                'meta_keywords'=>'required|string',
                'status'=>'boolean'
            ]);
            if ($validate->fails()) {
                # If Validation fails
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                # If Validation fails
                // File upload
                $file = $request->file('featured_image');
                $fileName = time() . '_' . $request->post_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Posts'), $fileName);

                $slug=Str::slug($request->post_name);
                // Post data
                $data = [
                    'post_name'         =>$request->post_name ,
                    'post_slug'         =>$slug,
                    'category_id'       =>$request->category_id,
                    'short_description' =>$request->short_description,
                    'description'       =>$request->description,
                    'featured_image'    =>$fileName,
                    'status'            =>$request->status,
                ];

                // Post meta data
                $postMetaData = [
                    'meta_title'        =>$request->meta_title ,
                    'meta_description'  =>$request->meta_description,
                    'meta_keywords'     =>$request->meta_keywords,
                ];

                $savePost = $this->postService->addPost($data,$postMetaData);
                if ($savePost['success']) {
                    return redirect('/admin/posts')->with('success', $savePost['message']);
                }
                return redirect()->back()->with('error', $savePost['message'])->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }


    // Vie All Posts
    public function index(){
        try {
            //code...
            $posts=$this->postService->getAllPostWithCategories();
            $success = $posts['success'] ?? false;
            $message = $posts['message'] ?? '';
            $data    = $posts['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.posts', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Post
    public function edit($post_id){
        try {
            //code...
            $post = $this->postService->getPost($post_id);
            $categories = $this->categoryServices->GetAllCategory();
            $success    = $post['success'] ?? false;
            $message    = $post['message'] ?? '';
            $data       = $post['data'] ?? [];
            $metaData   = $post['metadata'] ?? [];
            $allCategories = $categories['data'] ?? [];
            return view('Admin.post-create', compact('success', 'message', 'data','metaData','allCategories'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Update Post
    public function update(Request $request,$post_id){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'post_name'=>'required|string',
                'category_id'=>'required|exists:categories,category_id',
                'short_description'=>'required|string',
                'description'=>'required|string',
                'featured_image'=>'image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:width=800,height=500',
                'meta_title'=>'required|string',
                'meta_description'=>'required|string',
                'meta_keywords'=>'required|string',
                'status'=>'boolean'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            } else {
                 // Post data
                $slug=Str::slug($request->post_name);
                $data = [
                    'post_name'         =>$request->post_name ,
                    'post_slug'         =>$slug,
                    'category_id'       =>$request->category_id,
                    'short_description' =>$request->short_description,
                    'description'       =>$request->description,
                    'status'            =>$request->status,
                ];

                // Post meta data
                $postMetaData = [
                    'meta_title'        =>$request->meta_title ,
                    'meta_description'  =>$request->meta_description,
                    'meta_keywords'     =>$request->meta_keywords,
                ];

                if ($request->hasFile('featured_image')) {
                    $file = $request->file('featured_image');
                    $fileName = time() . '_' . $request->post_name . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('Posts'), $fileName);
                    $data['featured_image'] = $fileName;
                }
                $updatePost = $this->postService->updatePost($post_id,$data,$postMetaData);
                $message=$updatePost['message'];
                if ($updatePost['success']) {
                    return redirect('/admin/posts')->with('success',$message);
                } else {
                    return redirect()->back()->with('error', $th->getMessage())->withInput();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Delete Post
    public function delete($post_id){
        try {
            //code...
            $deletePost = $this->postService->deletePost($post_id);

            if (!empty($deletePost['success']) && $deletePost['success'] === true) {
                return redirect()->back()->with('success', $deletePost['message'] ?? 'Post deleted successfully!');
            }
            return redirect()->back()->with('error', $deletePost['message'] ?? 'Failed to delete Post.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
