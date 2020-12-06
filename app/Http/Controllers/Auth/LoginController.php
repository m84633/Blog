<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver('google')->user();
        $find_user = User::where('email',$user->getEmail())->first();
        if($find_user){
            Auth::login($find_user);
        }else{
            $new_user=new User();
            $new_user->email = $user->getEmail();
            $new_user->name = $user->getName();
            $new_user->password = bcrypt('opkl23584');
            $new_user->save();
            Auth::login($new_user);
        }

        return redirect('/');

        // return $user->getEmail();

        // dd($user->token);
    }
}
