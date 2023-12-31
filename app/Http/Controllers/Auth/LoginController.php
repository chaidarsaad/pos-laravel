<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated(){
        // if(Auth::user()->role_as == '1'){ //1 = Admin Login
        //     return redirect('dashboard')->with('status','Selamat datang di dashboard');
        // } elseif (Auth::user()->role_as == '0'){ // Normal or Default User Login
        //     return redirect('/')->with('status','Login berhasil');
        // }

        // Check for the admin role
        if (Auth::user()->role_as == '1') {
            return redirect('dashboard')->with('status','Selamat datang di dashboard');
        }

        // Check for the karyawan role
        elseif (Auth::user()->role_as == '2') {
            return redirect('dashboardkar')->with('status','Selamat datang di dashboard');
        }

        // Check for the customer role
        elseif (Auth::user()->role_as == '0') {
            return redirect('/')->with('status','Login berhasil');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
