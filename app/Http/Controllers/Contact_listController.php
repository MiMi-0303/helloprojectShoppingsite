<?php

namespace App\Http\Controllers;

use App\Models\task15login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class Contact_listController extends Controller
{
    public function Contact_list(Request $request)
    {
        $list = task15login::all(); //$listはコレクションという型,配列と同じ扱いができる
        //dd($list);
        return view('task15_admin', ['list' => $list]); //'list'は名前なんでもいい、識別子
    }
    public function Contact_id(Request $request)
    {
        $lists= $request->input('chk');
        //dd($lists);
        $lists = $lists[0];
        //dd($lists);
        $list = task15login::find($lists);
        //dd($list);
        return view('task15_admin2',['list' => $list]);

        //dd($post_id);
        //$list = task15login::all(); //$listはコレクションという型,配列と同じ扱いができる
        //dd($list);
        //@if(isset( $text ))
        //<p>$test</p>
        //@else
        //return view('task15_admin', ['list' => $list]); //'list'は名前なんでもいい、識別子
    }
    public function Contact_delete(Request $request)
    {
        $post_id =  $request->input('chk'); // $post_idは配列
        $entity = task15login::where('id',$post_id)->firstOrFail(); //セレクト文
        $entity->delete();

        return redirect()->route('Contactlist-view')->with('feedback.success', "削除いたしました");
        //dd( $post_id);
    }
    

    
}
