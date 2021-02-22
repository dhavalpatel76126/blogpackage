<?php

namespace Cct\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cct\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = BlogCategory::get();
        return view('blog::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->categoryname);

        $category = new BlogCategory();
        $category->category_name = $request->categoryname;
        $category->slug = $slug;
        $category->category_description = $request->categorydescription;
        $category->status = $request->status;
        $category->save();
        return redirect('admin/category');
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
        $category = BlogCategory::find($id);

        return view('blog::category.edit', compact('category'));
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

        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->categoryname);
        $category = BlogCategory::find($id);
        $category->category_name = $request->categoryname;
        $category->slug = $slug;
        $category->category_description = $request->categorydescription;
        $category->status = $request->status;
        $category->save();
        return redirect('admin/category');
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
