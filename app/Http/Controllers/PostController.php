<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function dashboard()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('dashboard', compact('posts'));
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tags       = Tag::orderBy('name', 'asc')->get();
        return view('post.create', compact('categories', 'tags'));
    }

    private function validatePost($request)
    {
        return $request->validate([
            'user_id' => 'required',
            'title' => 'required|string',
            'subtitle' => 'string',
            'content' => 'required',
            'category_id' => 'required|integer',
            'tag_id' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $post = Post::create($this->validatePost($request));
        $post->user_id = auth()->user()->id;
        $post->save();
        return back()->with('success', "Your New Post has been created!!");
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();

        return view('post.show', compact('post'));
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
        $post = Post::findorFail($id);
        $post->delete();
        return back()->with('error', "POST has been Deleted!!");
    }
}
