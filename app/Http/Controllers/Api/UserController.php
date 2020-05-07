<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCommentsResource;
use App\Http\Resources\AuthorPostsResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    /**
     * @return UsersResource
     */
    public function index()
    {
        $users=User::paginate(env('AUTHORS_PER_PAGE'));
        return new UsersResource($users);
        //
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required',
           'email'=>'required',
           'password'=>'required',

        ]);

        $user= new User();
        $user->name= $request->get('name');
        $user->email=$request->get('email');
        $user->password=Hash::make($request->get('password'));

        $user->save();
        return new UserResource($user);


    }

    /**
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {

        return  new UserResource(User::find($id));
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $user= User::find ($id);
        if($request->has('name')){
            $user->name= $request->get('name');
        }
        if($request->has('avatar')){
            $user->avatar=$request->get('avatar');
        }
        if($request->hasFile('avatar')){
            $featuredimage = $request->file('avatar');
            $filename=time().$featuredimage->getClientOriginalName();
            Storage::disk('images')->putFileAs(
                $filename,
                $featuredimage,
                $filename
            );
            $user->avatar=url('/').'/images/'.$filename;
        }

        $user -> save();
        return new UserResource($user);


    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return AuthorPostsResource
     */
    public function  posts($id)
    {
    $user=User::find($id);
    $post=$user->posts()->paginate(env('POSTS_PER_PAGE'));
    return new AuthorPostsResource($post);

    }

    /**
     * @param $id
     * @return AuthorCommentsResource
     */
    public  function AuthorComments($id) {
        $user=User::find($id);
        $comments=$user -> comments()->paginate(env('COMMENTS_PAR_PAGE'));
        return  new AuthorCommentsResource($comments);

    }

    public  function getToken(Request $request ){
        $request ->validate([
           'email'=>'required',
           'password'=> 'required',
        ]);

        $credential =$request->only('email','password');
        if(Auth::attempt($credential)){
            $user=User::where('email',$request->get('email'))->first();
            return new TokenResource([ 'token'=> $user->api_token]);

        }
        return 'not found';

    }

}
