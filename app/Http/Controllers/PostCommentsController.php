<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use App\Comment as CommentEloquent;
use Auth;
use Redirect;
use App\Post as PostEloquent;

class PostCommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post_id, CreateCommentRequest $request)
    {
        $comment = new CommentEloquent($request->only('content'));
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $post=PostEloquent::find($post_id);
        $post->comments()->save($comment);
        //$comment->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id)
    {   
        $comment = CommentEloquent::where('post_id', $post_id)->findOrFail($comment_id);
        if(Auth::user()->isAdmin() || Auth::id() == $comment->user_id){
            $comment->delete();
        }
        return Redirect::back();
    }
}
