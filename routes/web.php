<?php

use App\Admin;
use App\Events\testEvent;
use App\Notifications\mynoti;
use App\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('search', 'HomeController@search')->name('search');

//array
Route::get('fevor', function()
{
    $a=[];
    $a['comments']=5;
    $a['title']=6;
        //結論:collect的話,$a->title == $a['title']; array只能用[]
    $when=now();
    echo $when;
}); 
 


//測試static
Route::get('play', function(){
    $post=new Post();
    $post->play();
    $post->play();
    $post->play();
    $post->play();
    echo "<br>"."<br>"."<br>";
    $post2=new post;
    $post2->PLAY();
});

//點讚
Route::post('like','PostsController@like');


//notify
Route::get('not', function () {
    $users = Admin::all();
    $message = '通知6';
    foreach ($users as $user) {
        $user->notify(new mynoti($message));
    // $user->notifications()->delete();
    }
});
Route::post('markasread', function () {

    Auth::user()->unreadNotifications->markAsRead();
    // foreach (Auth::user()->unreadNotifications as $noti) {
    //     $noti->markasread();
    // }
    // return redirect()->back();
})->name('mark')->middleware('auth:admin');
Route::get('note', function () {
    $user = Admin::find(6)->get(); 
    $sub = '嗨';
    Notification::send($user, new mynoti());
});
Route::post('deletenot',function(){
    $id = request()->id;
    $user = Admin::find($id);
    if($user){
        $user->notifications()->delete();
    }
});
//notify

//event
Route::get('event', function () {
    event(new testEvent('hello'));
});

Auth::routes();

//test facades
Route::get('/facadeex', function () {
    return Test::testingFacades();
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('avatar', 'UsersController1@showAvatar')->name('showAvatar');
    Route::post('avatar', 'UsersController1@uploadAvatar')->name('uploadAvatar');
});

Route::get('/tags/{tags}','PostsController@tagshow')->name('tagShow');

Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);
Route::resource('posts.comments', 'PostCommentsController', ['only' => ['store', 'destroy']]);
Route::resource('users', 'UsersController');


Route::prefix('login/social')->name('social.')->group(function () {
    Route::get('{provider}/redirect', 'Auth\LoginController@redirectToProvider')->name('redirect');
    Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('callback');
});
Route::get('practice', 'HomeController@practice')->name('practice');

Route::namespace('admin')->name('admin.')->group(function () {
    Route::get('admin/home', 'HomeController@index')->name('home');
    Route::resource('admin/posts', 'PostsController')->except([
        'show',
    ]);
    Route::resource('admin/types', 'PostTypesController')->except([
        'show',
    ]);
    Route::resource('admin/tags', 'tagsController')->except([
        'show',
    ]);
    Route::get('admin/avatar', 'UsersController@showAvatar')->name('showAvatar');
    Route::resource('admin/users', 'UsersController')->except([
        'show',
    ]);
    Route::resource('admin/roles', 'RolesController')->except([
        'show',
    ]);
    Route::resource('admin/permissions', 'PermissionController')->except([
        'show',
    ]);
    Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('admin/login', 'Auth\LoginController@login');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

    //首頁vue拿資料
    Route::post('getPosts', 'PostsController@getAllPosts');

    //searchBar (首頁)
    Route::post('searchBack','PostsController@search');
    //searchBar (使用者)
    Route::post('getUsers','UsersController@getAllUsers');
    // Route::post('searchUser','UsersController@search');

});
// Route::get('foo', function () {
// $b = 5;
// $g = 1;
// for($c=0;$c<5;$c++){
// for($x=0;$x<$b;$x++)//印出空白
//  {
//  echo "_";
//  }
//       $b=$b-1;
// for($y=0;$y<$g;$y++)//印出星號
//  {
//  echo "*";
 
//  }
//  $g=$g+2;
//  echo "<br>";
// }
// });
// Route::get('{page}', function ($slug) {
//     echo $slug;
// });

//store圖片
// if($request->hasFile('image')){
//     $imageName=$request->image->store('public');
// }
// $post->img=$imageName;

//在view顯示
//@section('img',Storage::disk('local')->url($post->img));記得php artisan storage:link

//authenticatesusers.php->相關auth function;
//router.php看路由

//{!!htmlspecialchars_decode($post->body) !!}
