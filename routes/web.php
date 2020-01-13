<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('client.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('post', 'PostController@index')->name('post.index');

// Route::get('/{anypath}', 'HomeController@index')->where('path', '.*');

// Category
Route::group(['middleware' => ['auth']], function() {
    Route::post('/add-category', 'CategoryController@addCategory');
    Route::get('/category', 'CategoryController@getCategory');
    Route::get('/delete/{id}', 'CategoryController@deleteCategory');
    Route::get('/edit-category/{id}', 'CategoryController@editCategory');
    Route::post('/update-category/{id}', 'CategoryController@updateCategory');

    Route::get('/post', 'PostController@getPost');
    Route::post('/save-post', 'PostController@savePost');
    Route::get('/delete-post/{id}', 'PostController@deletePost');
    Route::get('/edit-post/{id}', 'PostController@editPost');
    Route::post('/update-post/{id}', 'PostController@updatePost');
});

