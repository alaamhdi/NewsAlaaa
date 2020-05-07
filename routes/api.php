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
/**
 * @user Related
 */
Route::get('authors','Api\\UserController@index');
Route::get('authors/{id}','Api\\UserController@show');
Route::get('posts/author/{id}','Api\\UserController@posts');
Route::get('comments/author/{id}','Api\\UserController@AuthorComments');


// End user Related
/**
 * @Post related
 */
// End Post Related
Route::get('categories','Api\\CategoriesController@index');
Route::get('posts/categories/{id}','Api\\CategoriesController@posts');
Route::get('posts','Api\\PostController@index');
Route::get('posts/{id}','Api\\PostController@show');
Route::get('comments/posts/{id}','Api\\Postcontroller@comments');


Route::post('register','Api\\UserController@store');
Route::post('token','Api\\UserController@getToken');




Route::middleware('auth:api')->group(function (){

    Route::post('update-user/{id}','Api\\UserController@update');
    Route::post('posts','Api\\PostController@store');
    Route::post('posts/{id}','Api\\PostController@update');
    Route::delete('posts/{id}','Api\\PostController@destroy');

    Route::post('comments/post/{id}',"Api\\CommentController@store");






});
