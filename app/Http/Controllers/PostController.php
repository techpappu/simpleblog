<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    //
    public function index(){
        $posts=Post::latest()->paginate(10);
        return view('welcome', ['posts'=>$posts]);
    }
    public function create(){
        return view('posts.createPost');
    }

    public function store(){
        $inputs= request()->validate([
            'title' => 'required|min:8|max:255',
            'body' => 'required',

        ]);
        auth()->user()->posts()->create($inputs);
        Session::flash('message','The Post has stored');

        return redirect()->back();
    }


    public function show($id){
        $post=Post::find($id);
        return view('posts.blogPost',['post'=>$post]);
    }

    public function edit(Post $post){
        return view('posts.postEdit',['post'=>$post]);
    }

    public function update(Post $post){
        $inputs= request()->validate([
            'title' => 'required|min:8|max:255',
            'body' => 'required',

        ]);
        $post->update($inputs);
        Session::flash('message','The Post has been updated');

        return redirect()->back();
    }
}
