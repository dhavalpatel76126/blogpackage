<?php

namespace Cct\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cct\Blog\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * add comment 
     */

    public function addComment(Request $request, $blogpostid, $blogSlug)
    {
        $addNewComment = new BlogComment();
        $addNewComment->blog_post_id = $blogpostid;
        $addNewComment->comment = $request->comment;
        $addNewComment->save();
        return redirect('showblogpost/' . $blogpostid . '/' . $blogSlug);
    }
    /**
     * Show all comments
     */
    public function showAllComments()
    {
        $allComments = BlogComment::get();
        return view('blog::comments.index', compact('allComments'));
    }

    /**
     * Approve comments by admin
     */
    public function changeCommentStatus(Request $request)
    {
        $commentId = $request->commentId;
        $comment = BlogComment::find($commentId);
        if ($request->status == 'published') {
            $comment->status = 'unpublished';
        } elseif ($request->status == 'unpublished') {
            $comment->status = 'published';
        }
        $comment->save();
        return ['Message' => 'Status updated successfully', 'success' => true];
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
