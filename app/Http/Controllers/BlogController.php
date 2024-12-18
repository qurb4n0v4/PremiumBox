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
        $blog = Blog::with('blogDetails')->findOrFail($id);  // Fetch blog with blog details
        $blogDetails = $blog->blogDetails; // No need to decode anything, just use the relationship

        return view('front.blogs.blogs_read_more', compact('blog', 'blogDetails'));
    }



}
