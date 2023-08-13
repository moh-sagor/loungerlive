<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $blogId)
    {
        $this->validate($request, [
            'content' => 'required|min:5'
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->content = $request->input('content');
        $blog->comments()->save($comment);

        return back()->with('success', 'Comment posted successfully.');
    }

}