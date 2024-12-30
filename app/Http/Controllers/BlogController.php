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
        $blog = Blog::findOrFail($id);

        $blogDetails = \DB::table('blog_details')
            ->where('blog_id', $id)
            ->value('blog_details');

        $blogDetails = is_string($blogDetails) ? json_decode($blogDetails, true) : $blogDetails;

        return view('front.blogs.blogs_read_more', compact('blog', 'blogDetails'));
    }



}
