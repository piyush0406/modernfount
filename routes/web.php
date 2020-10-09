<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WebController@welcome');
Route::get('/article', 'WebController@article');
Route::get('/authors', 'WebController@writers');
Route::get('/author/{id}', 'WebController@writer')->name('authordetail');
Route::get('/article/{id}', 'WebController@articleDisplay')->name('articledisplay');
Route::get('/tags', 'WebController@tags');
Route::get('/tag/{name}', 'WebController@tag')->name('tagdisplay');


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
	Route::get('/admin', 'WebController@adminDashboard')->name('admin');
	Route::get('/admin/user-creation', 'WebController@userCreation')->name('usercreation');
	Route::get('/admin/approval-request', 'WebController@approvalRequest');
	Route::get('/admin/article-success', 'WebController@adminSuccess');
	Route::get('/admin/user-success', 'WebController@userCreated');
	Route::get('/admin/articles', 'WebController@articles');
	Route::get('/admin/create-article', 'WebController@adminCreateArticle')->name('admincreatearticle');
	Route::get('/admin/cover-image/{id}', 'WebController@adminCoverImage')->name('admincoverimage');
	Route::get('/admin/edit-article/{id}', 'WebController@editArticleAdmin')->name('editArticle');
});

Route::group(['middleware' => 'App\Http\Middleware\WriterMiddleware'], function(){
	Route::get('/writer', 'WebController@writerDashboard')->name('writer');
	Route::get('/writer/article-listing', 'WebController@articleListing');
	Route::get('/writer/cover-image/{id}', 'WebController@writerCoverImage')->name('writercoverimage');
	Route::get('/writer/article-success', 'WebController@writerSuccess');
  Route::get('/writer/create-article', 'WebController@createArticle');
  Route::get('/writer/edit-article/{id}', 'WebController@editArticle')->name('editArticleWriter');
});



Auth::routes();
Route::group(['middleware' => 'guest'], function()
{
    // add all your routes here
   	Route::get('/signin', 'WebController@signin');
});

//Route::get('/home', 'HomeController@index')->name('home');
