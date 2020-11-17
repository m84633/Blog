<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Post as PostEloquent;
use App\Post;
use App\PostType as PostTypeEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Redirect;
use View;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:admin');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        $posts=Post::orderBy('created_at','DESC')->paginate(5);
        return view('admin.home',compact('posts'));
    }

    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $posts = PostEloquent::where('title', 'LIKE', "%$keyword%")->orwhere('content', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(5);
        return View::make('posts.index', compact('posts', 'keyword')); 
    }
    public function practice(){
        $collection = collect([
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Chair', 'price' => 160],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]);
        $collection->all();
        $filtered = $collection->whereIn('price', [150, 200]);
        
        $filtered=$filtered->all();
           // dd($filtered);
        
        return View::make('practice', compact('filtered'));
  

    }
}
