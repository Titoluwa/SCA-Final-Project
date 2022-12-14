<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private function validateCategory($request)
    {
        return $request->validate([
            'name' => 'required|string'
        ]);
    }
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('category.index', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::findorFail($id);
        $posts = Post::where('category_id', $id)->orderBy('id', 'asc')->get();
        return view('category.show', compact('category', 'posts'));
    }
    public function store(Request $request)
    {
        $category = Category::create($this->validateCategory($request));
        return back()->with('success', "New CATEGORY created!!");
    }
    public function destroy($id)
    {
        if(auth()->user()->id != 1)
        {
            return back()->with('error', "Access DENIED. You are not authorized to perform this Deletion");
        }else{
            $category = Category::findorFail($id);
            $posts = Post::where('category_id', $id)->get();
            foreach ($posts as $post)
            {
                $post->delete();
            }
            $category->delete();

            return response()->json(['status'=>"Category Deleted Successfully!"]);
        }
    }
}
