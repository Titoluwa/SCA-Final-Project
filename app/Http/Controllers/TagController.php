<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private function validateTag($request)
    {
        return $request->validate([
            'name' => 'required|string'
        ]);
    }
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        return view('tag.index', compact('tags'));
    }
    public function store(Request $request)
    {
        $tag = Tag::create($this->validateTag($request));
        return back()->with('success', "New TAG created!!");
    }
    public function destroy($id)
    {
        if(auth()->user()->id != 1)
        {
            return back()->with('error', "Access DENIED. You are not authorized to perform this Deletion");
        }else{
            $tag = Tag::find($id);
            $tag->delete();
            return response()->json(['status'=>"Tag Deleted Successfully!"]);
        }
    }

}
