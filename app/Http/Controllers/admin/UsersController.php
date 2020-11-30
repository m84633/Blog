<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth:admin');
       //  if (Auth::user()->can('admin.posts.create')) {
       //      return redirect()->back();
       // }
    }

    public function index()
    {   
        if(auth()->user()->can('usersupdate')){
            $users=Admin::all();
            return view('admin.users.users',compact('users'));
            //$request->status??$request['status']=0;沒傳入此欄位的話新增此欄位並設成0
        }
        return redirect()->route('admin.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(Auth::user()->can('usersadd')){
            $roles=Role::all();
            return view('admin.users.create',compact('roles'));
        }
        return redirect()->route('admin.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {   
        // return $request->avatar;
        if($request->hasFile('avatar')){
            if(Auth::user()->avatar){
                Storage::delete(Auth::user()->avatar);
            }
            $avatar=$request->avatar->store('public/'.'admin_'.Auth::user()->id);
        }
        $admin=new Admin($request->all());
        $admin->avatar=$avatar ?? null;
        $admin->password=bcrypt($request->password);
        //$request['password']=bcrypt($request->password)
        $admin->save();
        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.users.index');
    }

    public function showAvatar(){
        if(Auth::user()->avatar === null){
        $path=storage_path('app/public/default.jpg');
        $avatar=File::get($path);
        $type=File::mimeType($path);    
        }else{
        $path=storage_path('app'.'/'.Auth::user()->avatar);
        $avatar=File::get($path);
        $type=File::mimeType($path);
        }
        return response($avatar)->header("Content-Type",$type); 
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
    public function edit(Admin $user)
    {   
        if(auth()->user()->can('usersupdate')){
            $roles=Role::all();
            return view('admin.users.edit',compact('user','roles'));
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
    public function update(Request $request,Admin $user)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'name'=>'required|string'
        ]);
        if($request->hasFile('avatar')){
            if(Auth::user()->avatar){
                Storage::delete(Auth::user()->avatar);
            }
            $avatar=$request->avatar->store('public/'.'admin_'.Auth::user()->id);
        }
        $user->fill($request->all());
        $user->avatar=$avatar ?? null;
        $user->password=bcrypt($request->password);
        $user->save();
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function getAllUsers(){
        if(auth()->user()->can('usersupdate')){
            $users=Admin::with('roles')->paginate(5);
            return $users;
            //$request->status??$request['status']=0;沒傳入此欄位的話新增此欄位並設成0
        }
        return redirect()->route('admin.home');
    }
}
