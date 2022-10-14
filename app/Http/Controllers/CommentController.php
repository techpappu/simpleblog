<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Session;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {
        $comment = new Comment;
        $request->validate(['body' => 'required|min:8|max:255']);
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);
        Session::flash('message', 'comment store successfully');
        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $request->validate(['comment_body' => 'required|min:8|max:255']);
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);
        Session::flash('replay', 'comment replay successfully');
        return back();

    }
    public function delete($id){
        $comment=Comment::find($id);
        $this->authorize('delete',$comment);
        $comment->delete();
        Session::flash('deleteComment', 'Comment hide Successfully');
        return redirect()->back();
    }

}
