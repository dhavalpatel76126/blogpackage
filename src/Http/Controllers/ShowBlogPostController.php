<?php

namespace Cct\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cct\Blog\Models\BlogCategory;
use Cct\Blog\Models\BlogComment;
use Cct\Blog\Models\BlogPost;
use Cct\Blog\Models\BlogPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// use File;

class ShowBlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $blogPosts = BlogPost::where('status','published')->get();
        $allCategory = BlogCategory::where('status','published')->whereNotNull('category_name')->get();
        foreach ($blogPosts as $key => $blogPostvalue) {
            # code...
            $getCategoryWisePost = BlogPostCategory::select('blog_category_id')->where('blog_post_id', $blogPostvalue->id)->pluck('blog_category_id');
            $categoryBlogWise = BlogCategory::where('status','published')->whereNotNull('category_name')->whereIn('id', $getCategoryWisePost)->get();
            $blogPostvalue->category = $categoryBlogWise;
        }

        return view('blog::showblog.index', compact('blogPosts', 'allCategory'));
    }

    public function showBlogPostDetails($id, $slug)
    {
        $getBlogDetails = BlogPost::where('id', $id)->where('slug', $slug)->first();
        $comments = BlogComment::where('blog_post_id',$id)->get();
        return view('blog::showblog.blogdetails', compact('getBlogDetails','comments'));
    }

    public function showBlogPostByCategory($id, $slug)
    {
        $getCategoryWisePost = BlogPostCategory::select('blog_post_id')->where('blog_category_id', $id)->pluck('blog_post_id');
        $blogPosts = BlogPost::whereIn('id', $getCategoryWisePost)->get();
        $allCategory = BlogCategory::whereNotNull('category_name')->get();
        return view('blog::showblog.categoryblogpost', compact('blogPosts', 'allCategory', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
