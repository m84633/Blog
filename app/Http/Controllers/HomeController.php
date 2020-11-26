<?php

namespace App\Http\Controllers;

use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Redirect::action('PostsController@index');
    }

    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $user_search=User::where('name','LIKE',"%$keyword%")->get();
        // dd($user_search);
        $posts = PostEloquent::where('title', 'LIKE', "%$keyword%")->orwhere('content', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->get();
        return View::make('posts.index', compact('posts', 'keyword','user_search')); 
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
