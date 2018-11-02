<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use App\Like;
use App\Dislike;


use Auth;

class PostController extends Controller
{

    public function post() {
        $categories = Category::all();
        $posts = Post::all();

        return view('posts.post' , ['categories' => $categories , 'posts' => $posts]);
    }

    public function addPost(Request $request){
            $this->validate($request, [
                'post_title' => 'required',
                'post_body' => 'required',
                'category_id' => 'required',
                'post_image' => 'required',
            ]);
            $posts = new Post;
            $posts->post_title = $request->input('post_title');
            $posts->user_id = Auth::user()->id;
            $posts->post_body = $request->input('post_body');
            $posts->category_id = $request->input('category_id');
            $posts->post_image = $request->input('post_image');
            if(Input::hasFile('post_image')){
                $file = Input::file('post_image');
                $file->move(public_path(). '/posts/', $file->getClientOriginalName());
                $url = URL::to("/"). '/posts/'. $file->getClientOriginalName();

            }
            $posts->post_image = $url;
            $posts->save();
            return redirect('/home')->
            with('response', 'Post Added successfully');
    }

    public function view(Post $post){
        $likectr = Like::where(['post_id' => $post->id])->count();
        $dislikectr = Dislike::where(['post_id' => $post->id])->count();
        $categories = Category::all();
        return view('posts.view' ,[
            'post' => $post ,
            'categories' => $categories,
            'likectr' => $likectr,
            'dislikectr' => $dislikectr
        ]);
    }
    public function edit($post_id){
        $categories = Category::all();
        $posts = Post::find($post_id);
        $category = Category::find($posts->category_id);
        return view('posts.edit' , [
            'categories' => $categories,
            'posts' => $posts ,
            'category' => $category]);
    }
    public function editPost(Request $request , $post_id){
        $this->validate($request, [
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
        ]);
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->post_body = $request->input('post_body');
        $posts->category_id = $request->input('category_id');
        $posts->post_image = $request->input('post_image');
        if(Input::hasFile('post_image')){
            $file = Input::file('post_image');
            $file->move(public_path(). '/posts/', $file->getClientOriginalName());
            $url = URL::to("/"). '/posts/'. $file->getClientOriginalName();

        }
        $posts->post_image = $url;
        $data = array(
            'post_title' => $posts->post_title,
            'user_id' => $posts->user_id,
            'post_body' => $posts->post_body,
            'category_id' => $posts->category_id,
            'post_image' => $posts->post_image
        );
        Post::where('id' , $post_id)
        ->update($data);
        $posts->update();
        return redirect('/home')->
        with('response', 'Post Updated successfully');
    }
    public function deletePost($post_id){
        Post::where('id' , $post_id)
        ->delete();
        return redirect('/home')->
        with('response', 'Post Deleted successfully');

    }
    public function category($cat_id){
        $categories = category::all();
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.*')
            ->where(['categories.id' => $cat_id])
            ->get();
        return view('categories.categoriesposts' , ['categories' => $categories , 'posts' => $posts]);
    }
    public function like(Post $post){
        $loggedin_user = Auth::user()->id;
        $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $post->id])->first();
        if(!$like_user){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect()->back();
        }
        else{
            $like_user->delete();
            return redirect()->back();
        }
    }
    public function dislike(Post $post){
        $loggedin_user = Auth::user()->id;
        $dislike_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if(!$dislike_user){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect()->back();
        }
        else{
            $like_user->delete();
            return redirect()->back();
        }
    }
}
