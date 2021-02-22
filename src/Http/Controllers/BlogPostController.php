<?php

namespace Cct\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cct\Blog\Models\BlogCategory;
use Cct\Blog\Models\BlogPost;
use Cct\Blog\Models\BlogPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use File;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = BlogPost::get();
        return view('blog::blogpost.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategory = BlogCategory::whereNotNull('category_name')->get();
        return view('blog::blogpost.create', compact('allCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title);

        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('blogpost\images');
        $image->move($destinationPath, $imagename);
        $blogPost = new BlogPost();
        $blogPost->slug = $slug;
        $blogPost->user_id = 1;
        $blogPost->title = $request->title;
        $blogPost->subtitle = $request->subtitle;
        $blogPost->meta_title = $request->metatitle;
        $blogPost->meta_desc = $request->metadescription;
        $blogPost->meta_tags = $request->metatags;
        $blogPost->post_body = $request->postbody;
        $blogPost->status = $request->status;
        $blogPost->image = $imagename;
        $blogPost->save();

        $lastBlogPostId = $blogPost->id;
        $blogCategory = $request->category;
        foreach ($blogCategory as $key => $blogCategoryId) {
            $newBlogPostCategory =  new BlogPostCategory();
            $newBlogPostCategory->blog_post_id = $lastBlogPostId;
            $newBlogPostCategory->blog_category_id = $blogCategoryId;
            $newBlogPostCategory->save();
        }
        return redirect('admin/allblogpost');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogPost = BlogPost::find($id);
        $allCategory = BlogCategory::select(['id', 'category_name'])->whereNotNull('category_name')->get();
        $selectedCategory = BlogPostCategory::where('blog_post_id', $id)->get();

        foreach ($allCategory as $key => $value) {

            if ($selectedCategory->contains('blog_category_id', $value->id)) {
                $value->selected = 'selected';
            }
        }
        return view('blog::blogpost.edit', compact('blogPost', 'allCategory', 'selectedCategory'));
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
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title);
        $blogPost = BlogPost::find($id);

        if ($request->image != null) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('blogpost\images');
            $image->move($destinationPath, $imagename);
            $blogPost->image = $imagename;
        }
        $blogPost->slug = $slug;
        $blogPost->user_id = 1;
        $blogPost->title = $request->title;
        $blogPost->subtitle = $request->subtitle;
        $blogPost->meta_title = $request->metatitle;
        $blogPost->meta_desc = $request->metadescription;
        $blogPost->meta_tags = $request->metatags;
        $blogPost->post_body = $request->postbody;
        $blogPost->status = $request->status;
        $blogPost->save();
        $lastBlogPostId = $id;
        $blogCategory = $request->category;

        BlogPostCategory::where('blog_post_id', $id)->delete();
        foreach ($blogCategory as $key => $blogCategoryId) {
            $newBlogPostCategory =  new BlogPostCategory();
            $newBlogPostCategory->blog_post_id = $lastBlogPostId;
            $newBlogPostCategory->blog_category_id = $blogCategoryId;
            $newBlogPostCategory->save();
        }
        return redirect('admin/allblogpost');
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
