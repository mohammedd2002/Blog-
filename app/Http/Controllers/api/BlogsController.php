<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(4);
        if (count($blogs) > 0) {
            return ApiResponse::sendResponse(200, 'Blogs Retrieved Successfully', $blogs);
        }
        return ApiResponse::sendResponse(200, 'No Blogs Available', []);
    }

    public function latest()
    {
        $blogs = Blog::latest()->take(3)->get();
        if (count($blogs) > 0) {
            return ApiResponse::sendResponse(200, 'Latest blogs Retrieved Successfully', BlogResource::collection($blogs));
        }
        return ApiResponse::sendResponse(200, 'No Blogs Available', []);
    }

    public function category(Request $request)
    {
        $blogs = Blog::where('category_id', $request->input('cat'))->get();
        if (count($blogs) > 0) {
            return ApiResponse::sendResponse(200, 'blogs Retrieved Successfully', BlogResource::collection($blogs));
        }
        return ApiResponse::sendResponse(200, 'No Blogs Available', []);
    }

    public function user(Request $request)
    {
        $blogs = Blog::where('user_id', $request->input('user'))->get();
        if (count($blogs) > 0) {
            return ApiResponse::sendResponse(200, 'blogs Retrieved Successfully', BlogResource::collection($blogs));
        }
        return ApiResponse::sendResponse(200, 'No Blogs Available', []);
    }

    public function create(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $image = $request->image;
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('blogs', $newImageName, 'public');
        $data['image'] = $newImageName;
        $data['user_id'] = $request->user()->id;
        $create = Blog::create($data);
        if ($create) {
            return ApiResponse::sendResponse(201, 'Your Blogs Create Successfully', new BlogResource($create));
        }
    }

    public function update(StoreBlogRequest $request, $blogId)
    {
        $blog = Blog::find($blogId);
        if ($blog->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'You are not allowed to take this action ', []);
        }
        $data = $request->validated();
        $image = $request->image;
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('blogs', $newImageName, 'public');
        $data['image'] = $newImageName;
        $update = $blog->update($data);
        if ($update) {
            return ApiResponse::sendResponse(201, 'Your Blogs Create Successfully', new BlogResource($blog));
        }
    }

    public function delete(Request $request, $blogId)
    {
        $blog = Blog::find($blogId);
        if ($blog->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'You are not allowed to take this action ', []);
        }
        $delete = $blog->delete();
        if ($delete) {
            return ApiResponse::sendResponse(200, 'Your Blog Delete Successfully ', []);
        }
    }

    public function myBlogs(Request $request)
    {
        $blog = Blog::where('user_id', $request->user()->id)->latest()->get();
        if (count($blog) > 0) {
            return ApiResponse::sendResponse(200, ' My Blogs Retrieved Successfully', BlogResource::collection($blog));
        }
        return ApiResponse::sendResponse(200, 'You don\'t have any Blogs',[]);
    }
}
