<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        Comment::create($data);
        return back()->with('commentCreateStatus', 'your comment published sussfully');
    }
}
