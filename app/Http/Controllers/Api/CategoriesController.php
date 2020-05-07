<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\categoriesResource;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @return categoriesResource
     */

    public function index()
    {
        return  new categoriesResource(Category::paginate(env('CATEGORIES_PER_PAGE')));

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public  function posts( $id ){
        $category=Category::find($id)   ;
        $post=$category ->posts()-> paginate(env('POSTS_PER_PAGE'));
        return new PostsResource($post);

    }

}
