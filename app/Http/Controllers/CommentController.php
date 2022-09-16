<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }
    private function validateComment($request)
    {
        return $request->validate([
            'post_id' => 'required|integer',
            'content' => 'required|string',
            'user_id' => 'required|integer',
        ]);
    }
    public function store(Request $request)
    {
        $comment = Comment::create($this->validateComment($request));
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back()->with('success', "Your Comment has been added!!");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $comment = Comment::findorFail($id);
        $comment->delete();
        return response()->json(['status'=>"Comment Deleted Successfully!"]);
    }
}
