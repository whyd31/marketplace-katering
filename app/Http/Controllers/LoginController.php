<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Profil;
use App\Models\ImageProperty;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{

    protected $maxAttempts = 2; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'includeHero' => false,
            'profile' => Profil::latest()->get(),
            'footers' => Footer::latest()->get(),
            'active' => 'login',
            'propertiez'  => ImageProperty::where('property', 'Banner')->latest()->get(),
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get(),
        ]);
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            Auth::logoutOtherDevices(request('password'));

            $request->session()->regenerate();

            Alert::success('Success', 'Selamat Berhasil Login!');

            return redirect()->back()->with('success', 'This is a success message!');
            
        } 

        // SweetAlert message here
        Alert::error('Error', 'Email dan Password Salah!');

        return redirect('/login')->with('error', 'Email dan Password Salah!');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
