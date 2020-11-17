<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserAvatarRequest;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Auth;
//use View;
use File;
use Redirect;
use App\User as UserEloquent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAvatar()
    {
        return View::make('users.avatar');
    }

    public function uploadAvatar(UserAvatarRequest $request)
    {
        if (!$request->hasFile('avatar')) {
            return Redirect::route('index');
        }

        $file = $request->file('avatar');
        $destPath = 'images/avatars';

        if (!file_exists(public_path().'/'.$destPath)) {
            File::makeDirectory(public_path().'/'.$destPath, 0755, true);
        }

        $ext = $file->getClientOriginalExtension();
        $fileName = (Carbon::now()->timestamp).'.'.$ext;
        $file->move(public_path().'/'.$destPath, $fileName);

        $user = Auth::user();
        $user->avatar = $destPath.'/'.$fileName;
        $user->save();

        return Redirect::route('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserEloquent::where('type', '0')->orderBy('id', 'ASC')->paginate(5);

        return view('auth.user', compact('users'));
        //return View::make('auth.user', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserEloquent::findOrFail($id);
        //return View::make('auth.edit',compact('user'));
        return view('auth.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {   
        $password=Hash::make($request->password);
        $user = UserEloquent::findOrFail($id);
        $user->fill($request->except('password'));
        $user->fill(['password'=>$password]);
        $user->save();
        return Redirect::route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserEloquent::findOrFail($id);
        $user->delete();

        return Redirect::back();
    }
}
