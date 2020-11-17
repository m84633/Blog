<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAvatarRequest;
use Carbon\Carbon;
use Auth;
use View;
use File;
use Redirect;

class UsersController1 extends Controller
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
        echo $file->getClientSize().'<br>';
        echo $file->getsize().'<br>';
        echo $file->path()."<br>";
        echo $file->getClientOriginalName().'<br>';
        echo $file->getClientOriginalExtension();
       //dd($file);
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
}
