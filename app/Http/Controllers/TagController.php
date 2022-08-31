<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        return view('tag.index', compact('tags'));
    }
    public function store(Request $request)
    {
        $tag = Tag::create($this->validateTag($request));
        return back()->with('added_message', "New TAG created!!");
    }
    public function destroy($id)
    {
        $tag = Tag::findorFail($id);
        $tag->delete();
        return back()->with('delete_message', "TAG has been Deleted!!");
    }
    private function validateTag($request)
    {
        return $request->validate([
            'name' => 'required|string'
        ]);
    }
}
