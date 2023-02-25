<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function Auth(Request $request)
    {
        $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)===TRUE){ //Auth→モジュール,コンポーネント　Middlewareとは別
            $request->session()->regenerate();
            return redirect()->route('Contactlist-view');
        }
        else {
            return redirect()->route('login');
        }
        //dd($user_data);
        //if(Auth::attempt($user_data)){
            //$request->session()->regenerate();
            //return redirect()->route('task15_admin');
        //}
        //return redirect()->back();
        //return view('task15_admin');       
    }

}
