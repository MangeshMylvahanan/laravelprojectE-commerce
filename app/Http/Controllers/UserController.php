<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function Login(){
        return view('Auth.login');
    }
    public function GoogleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function LoginWithGoogle(){
        $user = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('google_id',$user->id)->first();

        if ($finduser){
            Auth::login($finduser);
            Session::put('user',$user);
            return redirect('/');
        }
        else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->google_id = $user->id;
            $new_user->role = '2';
            $new_user->password = bcrypt('123456');
            $new_user->save();
            return redirect('/');
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
