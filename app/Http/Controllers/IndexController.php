<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function login(Request $request)
    {
        $massage='';
        if ($request->method() == 'GET') {
        } else {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
             //入力された情報(email,password)が正しいか判断する
            if (Auth::attempt($credentials) === TRUE) {//Auth→モジュール,コンポーネント　Middlewareとは別。Authの設定ファイル→config/auth.php。そこにModel/Userと紐づいている
                $request->session()->regenerate();
                return redirect()->route('Contactlist-view');
            }
            $massage='ログイン失敗';
        }
        return view('task15_login',['loginfailed'=>$massage]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
