<?php

namespace App\Http\Controllers\SampleSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class LoginController extends Controller
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
                $request->session()->regenerate();//regenerateメソッドを実行することでセッションIDを再生成する
                return redirect()->route('site_product');
            }
            $massage='ログイン失敗しました';
        }
        return view('SampleSite.login',['loginfailed'=>$massage]); //スラッシュの代わりに"."を使う
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('site_login');
    }
}
