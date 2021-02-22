<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Backend routes

Route::group(['namespace' => 'Cct\Blog\Http\Controllers', 'middleware' => 'checkPermission', 'prefix' => 'admin'], function () {

    // add category
    Route::get('category/create', 'BlogCategoryController@create')->name('categorycreate');
    Route::get('category', 'BlogCategoryController@index')->name('category');
    Route::get('category/edit/{id}', 'BlogCategoryController@edit')->name('categoryedit');
    Route::post('category', 'BlogCategoryController@store');
    Route::patch('category/update/{id}', 'BlogCategoryController@update')->name('categoryupdate');

    // add blogpost
    Route::get('allblogpost/create', 'BlogPostController@create')->name('allblogpostcreate');
    Route::get('allblogpost', 'BlogPostController@index')->name('allblogpost');
    Route::get('allblogpost/edit/{id}', 'BlogPostController@edit')->name('allblogpostedit');
    Route::post('allblogpost', 'BlogPostController@store');
    Route::patch('allblogpost/update/{id}', 'BlogPostController@update')->name('allblogpostupdate');

    // comment section
    Route::get('allcomments', 'BlogCommentController@showAllComments')->name('showAllComments');

    // change comment status
    Route::post('changeCommentStatus','BlogCommentController@changeCommentStatus')->name('changeCommentStatus');

});

Route::group(['namespace' => 'Cct\Blog\Http\Controllers'], function () {

    // show blogpost
    Route::get('showblogpost', 'ShowBlogPostController@index')->name('showblogpost');
    Route::get('showblogpost/{id}/{slug}', 'ShowBlogPostController@showBlogPostDetails')->name('showblogpostdetails');

    //get category wise blog posts
    Route::get('category/{id}/{slug}', 'ShowBlogPostController@showBlogPostByCategory')->name('showBlogPostByCategory');

    // add comment 
    Route::post('addcomment/{blogpostid}/{blogSlug}', 'BlogCommentController@addComment')->name('addComment');
});
