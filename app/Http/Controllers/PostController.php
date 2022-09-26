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
            'subtitle',
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
        return redirect('/posts')->with('success', "Your New Post has been created!!");
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $tags = array();
        foreach($post->tag_id as $tag)
        {
            $tagg = Tag::where('id', $tag)->select('name')->first();
            array_push($tags, $tagg);
        }
        // dd($tags);
        return view('post.show', compact('post', 'tags'));
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        $categories = Category::orderBy('name', 'asc')->get();
        $tags       = Tag::orderBy('name', 'asc')->get();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->tag_id = $request->tag_id;
        $post->update();
        return redirect('/post/'.$post->id)->with('success', "Your Post has been Updated!!");
    }

    public function destroy($id)
    {
        $post = Post::findorFail($id);
        $post->delete();
        return response()->json(['status'=>"Post Deleted Successfully!"]);
    }
}
