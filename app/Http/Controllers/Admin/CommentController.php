<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['product', 'user'])->latest()->paginate(4);

        return view('admin.comments.index', compact('comments'));
    }

    public function changeStatus(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => ['required', Rule::in(Comment::ALL_STATUSES)],
        ]);

        $comment->update(['status' => $request->get('status')]);

        return response('', 200);
    }
}
