<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login','Api\UserController@login');
Route::get('/articlelist','Api\ArticleController@index');
Route::get('/authorlist','Api\AuthorController@index');
Route::get('/articlelist/{author_id}','Api\ArticleController@getArticleById');
Route::get('/taglist','Api\TagController@uniqueTags');
Route::get('/dashboard','Api\ArticleController@dashboardCount');

//Route::Group(['middleware' => [
//	'auth:api',
//]], function (
//) {
    Route::post('/register','Api\UserController@register')->name('createuser');

    Route::post('/createarticle','Api\ArticleController@store')->name('createarticle');
    Route::post('/createarticlewriter','Api\ArticleController@storeWriter')->name('createarticlewriter');
		Route::post('/createauthor','Api\AuthorController@store')->name('createauthor');
    Route::post('/articlestatus','Api\ArticleController@updateApprovedStatus')->name('articlestatus');
    Route::post('/articlesecondarystatus','Api\ArticleController@updateSecondaryStatus')->name('articlesecondarystatus');
    Route::post('/articleherostatus','Api\ArticleController@updateHero')->name('articleherostatus');
    Route::get('/unapprovearticle','Api\ArticleController@unapproveArticle');
    Route::put('/updateuser/{id}','Api\UserController@update');
    Route::get('/deleteuser/{id}','Api\UserController@destroy');
    Route::post('/updatearticle','Api\ArticleController@update')->name('updatearticle');
    Route::post('/deletearticleA','Api\ArticleController@destroyApproved')->name('deletearticleA');
    Route::post('/deletearticleUn','Api\ArticleController@destroyUnapproved')->name('deletearticleUn');
    Route::post('/updateauthor','Api\AuthorController@update')->name('updateauthor');
    Route::post('/updateimage','Api\AuthorController@updateImage')->name('updateimage');
    Route::post('/updatecoverimage','Api\ArticleController@updateCoverImage')->name('updatecoverimage');
    Route::post('/updateadmincoverimage','Api\ArticleController@updateAdminCoverImage')->name('updateadmincoverimage');
    Route::post('/editcoverimage','Api\ArticleController@editCoverImage')->name('editcoverimage');
    Route::post('/editadmincoverimage','Api\ArticleController@editAdminCoverImage')->name('editadmincoverimage');
    Route::get('/deleteauthor/{id}','Api\AuthorController@destroy');
    Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');
