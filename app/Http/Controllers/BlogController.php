<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogDetails')->get();
        return view('front.blogs', compact('blogs'));
    }

    public function show($id)
    {
        // Eager load the blogDetails relationship for the selected blog
        $blog = Blog::with('blogDetails')->findOrFail($id);
        $blogDetails = $blog->blogDetails;  // Access the eager-loaded relationship
        return view('front.blogs.blogs_read_more', compact('blog', 'blogDetails'));
    }
}
