<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $blog_id)
    {
        $comments = Comment::where('blog_id', $blog_id)->get();
        if (count($comments)>0) {
            return ApiResponse::sendResponse(200, 'Comments Retrieved Successfully', CommentResource::collection($comments));
        }
        return ApiResponse::sendResponse(200, 'Comments Not Found', []);
    }
}
