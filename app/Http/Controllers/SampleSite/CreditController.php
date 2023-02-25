<?php

namespace App\Http\Controllers\SampleSite;

use App\Models\Credit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class CreditController extends Controller
{
    public function existingCard(Request $request) //postだからRequest必要
    {
        $chkerror_massage = ''; //未入力時の初期値
        $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
        //dd($existingCardlist);
        return view('SampleSite.credit-register', ['chkerrorMessage' => $chkerror_massage,'existingCardlist' => $existingCardlist]); //'list'は名前なんでもいい、識別子

    }


    /*public function creditChoose(Request $request) //postだからRequest必要
    {
        dd($request);
        $user_id = Auth::user()->id;
       // dd($request->number);
        $credit_data=[
        'user_id' => $user_id,
         'number' => $request->number,
         'expire_y' => $request->card_exp_year,
         'expire_m' => $request->card_exp_month,
          'name' => $request->card_owner
        //save()メソッドを使う
         ];
         $data =new Credit();
         $data->fill($credit_data)->save();
         $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
         return view('SampleSite.pre-purchase-list', ['data'=>$data,'existingCardlist' => $existingCardlist]);

    }*/
}
