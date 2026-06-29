<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PostServices;

use App\Helpers\PaginationHelper;

class BlogController extends Controller
{
    protected $postServices;
     protected $categoryServices;

    // Inject Attribute Image service using constructor
    public function __construct(PostServices $postServices){
        $this->postServices = $postServices;
    }

    // Index Blogs Page
    public function index(){
        try {
            //code...
            $posts      = $this->postServices->getAllActivePost();
            $success    = $posts['success'] ?? false;
            $message    = $posts['message'] ?? '';
            $data       = $posts['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 15);
            return view('User.blogs', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Index Blog Details
    public function details($post_slug,$post_id){
        try {
            //code...
            $post      = $this->postServices->getPostDetails($post_id);
            $allPosts      = $this->postServices->getAllActivePost();

            $data       = $post['data'] ?? [];
            $posts       = $allPosts['data'] ?? [];

            return view('User.blog-details', compact('data','posts'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

}
