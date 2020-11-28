<?php

namespace App\Http\Controllers;

use App\Comment as CommentEloquent;
use App\Http\Requests\PostRequest;
use App\Like;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\Tags;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use View;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware(['auth'], [
            'except' => [
                'index', 'show'
            ]
        ]);

        $this->middleware(['admin'], [
            'only' => [
                'edit', 'update', 'destroy',
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        
        // $time=now();
        $posts = PostEloquent::orderBy('created_at', 'DESC')->paginate(5);
        if (Auth::viaRemember()) {
            $auth=1;
        }else{
            $auth=0;
        }

        return view::make('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
        $post_tags = Tags::all();
    
        return View::make('posts.create', compact('post_types','post_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new PostEloquent($request->all());
        //$request->except('user_id')
        $post->user_id = Auth::user()->id;
        $post->save();
        $post->tags()->sync($request->tags);
        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostEloquent $post)
    {
        //$post = PostEloquent::findOrFail($id);
       
        //$comments = CommentEloquent::where('post_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
        //return View::make('posts.show', compact('post', 'comments'));
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ids)
    {
        $post = PostEloquent::findOrFail($ids);
        $post_types = PostTypeEloquent::orderBy('name' , 'ASC')->get();
        $post_tags = Tags::all();
        return View::make('posts.edit', compact('post', 'post_types','post_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request,PostEloquent $post)
    {
        //$post = PostEloquent::findOrFail($id);
	    $post->fill($request->all());
	    $post->save();
        $post->tags()->sync($request->tags);
	    return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostEloquent::findOrFail($id);
        $post->delete();
        return Redirect::route('posts.index');
    }

    public function like(Request $request){
        $check=like::where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->first();
        if($check){
            $check->delete();
            return 'delete';
        }else{

            $like=new Like();
            $like -> user_id = $request->user_id;
            $like -> post_id = $request->post_id;
            $like->save();
        }
    }

    public function tagshow(Tags $tags){
        $posts = $tags->posts()->paginate(5);
        $tag = $tags->slug;
         return view::make('posts.index', compact('posts','tag'));
    }
}
