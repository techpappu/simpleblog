<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;

class AdminController extends Controller
{
    //
    public function index(){
        $posts=Post::withTrashed()->paginate(10);
        return view('admin.index',['posts'=>$posts]);
    }
    public function delete($id){
        Post::find($id)->delete();
        Session::flash('hide', 'Post ID:'.$id.' hide Successfully');
        return redirect()->back();
    }
    public function restore($id){
        Post::withTrashed()->find($id)->restore();
        Session::flash('show', 'Post ID:'.$id.' Successfully restored');
        return redirect()->back();
    }
}
