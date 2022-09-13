<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function post_count($category_id)
    {
        $post_count = Post::where('category_id', $category_id)->count();
        return $post_count;
    }
    
}
