<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\PostType;
use App\Tags;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        
        $this->middleware('auth:admin');
    }

    public function index()
    {   
       $posts=Post::orderBy('created_at','DESC')->paginate(5);
       // $truncated = Str::limit('大家好啊', 2, ' (...)');
        return view('admin.post.post',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Auth::user()->can('admin.posts.create')) {
            $post_types=PostType::all();
            $tags=Tags::all();
            return view('admin.post.create',compact('post_types','tags'));
       }
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post=new Post($request->all());
        $post->user_id=1;
        $post->save();
        $post->tags()->sync($request->tag);
        return redirect()->route('admin.posts.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::user()->can('admin.posts.update')){
        $types=PostType::all();
        $tags=Tags::all();
        return view('admin.post.edit',compact('post','types','tags'));
        }
        return redirect()->route('admin.home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $post->update($request->all());
        $post->tags()->sync($request->tag);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');      
    }

    public function getAllPosts(){
       return $posts=Post::with('user')->orderBy('created_at','DESC')->paginate(5);
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        return Post::with('user')->where('title', 'LIKE', "%$keyword%")->orwhere('content', 'LIKE', "%$keyword%")->orWhereHas('user',function (Builder $query) use($keyword){
                $query->where('name','LIKE',"%$keyword%");
        })->orderBy('created_at', 'DESC')->get();
    }
}
