<?php

namespace App\Http\Controllers\SampleSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProductList;
use App\Models\Credit;


class ViewController extends Controller
{
    //商品一覧表示
    public function site_product(Request $request)
    {
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        $list = ProductList::all(); //$listはコレクションという型,配列と同じ扱いができる
        //dd($list);
        return view('SampleSite.product-list', ['list' => $list, 'chkerrorMessage' => $chkerror_massage]); //'list'は名前なんでもいい、識別子
    }


    //カートに追加
    public function add_cart(Request $request) //カートに入れた情報を送るのでリクエスト要
    {
        //dd($_POST['chk']);
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        if (empty($_POST['chk'])) { //name='chk[]'が空ならchkerror_massageを表示
            $chkerror_massage = "少なくとも1つはチェックしてください";
            $list = ProductList::all(); //$listはコレクションという型,配列と同じ扱いができる
            return view('SampleSite.product-list', ['list' => $list, 'chkerrorMessage' => $chkerror_massage]);
        } else {
            $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
            //->get('cart-data',[]) 第一引数キー名、第二引数キーの配列がなければ設定した値
            //$cartData = [];//空の配列
            $post_id =  $request->input('chk'); // $post_idは配列
            $post_value =  $request->input('value');
            $post_name =  $request->input('p-name');
            $post_price =  $request->input('price');
            foreach ($post_id as $product_id) { //$post_idが0番目取ってきた時中身が$product_idに代入される
                $total = $post_value[$product_id];
                $name = $post_name[$product_id];
                $price = $post_price[$product_id];
                $ishit = false;
                $count = count($cartData);
                //dd($count);
                for ($i = 0; $i < $count; $i++) {
                    if ($product_id === $cartData[$i]['product_id']) {
                        $ishit = true; //ある時追加されない
                        $cartData[$i]['total'] = $cartData[$i]['total'] + $total;
                    }
                }
                if ($ishit == false) { //ない時false
                    $row = [];
                    $row['product_id'] = $product_id; //任意にキー名前を付けた
                    $row['total'] = $total;
                    $row['name'] = $name;
                    $row['price'] = $price;
                    $cartData[] = $row; //rowは最初からの配列で最終$cartData[]の末尾に追加
                } else {
                }
            }
            //合計金額表示
            $TotalPrice = 0;
            $count = count($cartData);
            for ($i = 0; $i < $count; $i++) {
                $t = $cartData[$i]['total'] * $cartData[$i]['price'];
                $TotalPrice = $TotalPrice + $t;
            }
            $request->session()->put('cart-data', $cartData); //put('key', 'value');
            //ログインした時点でユーザーのユニークなIDがふられている
            return view('SampleSite.add-cart', ['cartData' => $cartData, 'TotalPrice' => $TotalPrice, 'chkerrorMessage' => $chkerror_massage]);
        }
    }

    //カートを表示
    public function view_cart(Request $request) //カートに入れた情報を送るのでリクエスト要
    {
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        $cartData  = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示        //合計金額表示
        $TotalPrice = $this->calcTotalPrice($cartData); //初期値0

        return view('SampleSite.add-cart', ['cartData' => $cartData, 'TotalPrice' => $TotalPrice, 'chkerrorMessage' => $chkerror_massage]);
    }

    public function change_value(Request $request) //カート内の商品個数変更
    {
        $data = ['productId' => $request->input('product_id'), 'chValue' => $request->input('total')];
        // echo'<script>console.log('.json_encode($data).');</script>';
        $data['result'] = 'NG';
        $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
        $count = count($cartData); //count関数では、配列や連想配列の要素の数をカウントする
        //echo'<script>console.log('.json_encode($cartData).');</script>';
        //echo'<script>console.log('.json_encode($count).');</script>';
        //dd($cartData);
        for ($i = 0; $i < $count; $i++) {
            if ($data['productId'] === $cartData[$i]['product_id']) {
                $cartData[$i]['total'] = $data['chValue'];
                $data['result'] = 'OK';
            } else {
            }
        }
        $request->session()->put('cart-data', $cartData); //put('key', 'value');
        return response()->json($data['result']);
    }

    public function purchase_delete(Request $request) //カート内の商品削除
    {
        //dd($motourl);
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        if (empty($_POST['chk'])) { //name='chk[]'が空ならchkerror_massageを表示
            $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
            $chkerror_massage = "少なくとも1つはチェックしてください";
            // dd('〇');
            //return view('SampleSite.add-cart', ['cartData'=>$cartData,'chkerror_massage' => $chkerror_massage,'TotalPrice'=>$TotalPrice  ]);
        } else {
            // dd('〇');
            $cartData = $this->deleteCartdata($request);
        }
        $TotalPrice = $this->calcTotalPrice($cartData);
        return view('SampleSite.add-cart', ['cartData' => $cartData, 'TotalPrice' => $TotalPrice, 'chkerrorMessage' => $chkerror_massage]);
    }
    private function calcTotalPrice($cartData)
    {
        $TotalPrice = 0; //初期値0
        $count = count($cartData); //count関数では、配列や連想配列の要素の数をカウントする
        for ($i = 0; $i < $count; $i++) {
            $t = $cartData[$i]['total'] * $cartData[$i]['price'];
            $TotalPrice = $TotalPrice + $t;
        }
        return $TotalPrice;
    }

    public function pre_purchase_delete(Request $request)
    {
        $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        if (empty($_POST['chk'])) { //name='chk[]'が空ならchkerror_massageを表示
            $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
            $chkerror_massage = "少なくとも1つはチェックしてください";
            // dd('〇');
            //return view('SampleSite.add-cart', ['cartData'=>$cartData,'chkerror_massage' => $chkerror_massage,'TotalPrice'=>$TotalPrice  ]);
        } else {
            // dd('〇');
            $cartData = $this->deleteCartdata($request);
        }
        $TotalPrice = $this->calcTotalPrice($cartData);

        return view('SampleSite.pre-purchase-list', ['cartData' => $cartData, 'TotalPrice' => $TotalPrice, 'chkerrorMessage' => $chkerror_massage,'existingCardlist'=> $existingCardlist]);
    }

    private function deleteCartdata(&$request) //&→参照渡し　箱の場所だけを教えている
    {
        $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
        // dd($cartData);
        $count = count($cartData); //count関数では、配列や連想配列の要素の数をカウントする
        foreach ($_POST['chk'] as $id) {
            for ($i = 0; $i < $count; $i++) {
                if ($id === $cartData[$i]['product_id']) {
                    unset($cartData[$i]);
                } else {
                }
            }
        }
        $cartData = array_values($cartData);
        $request->session()->put('cart-data', $cartData); //put('key', 'value');
        return $cartData;
    }
    public function pre_purchase(Request $request) //カートに入れた情報を送るのでリクエスト要
    {
        
        $chooseNo='';
        $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
        $address = Auth::user();
        //dd($address);
        $chkerror_massage = ''; //チェックが1つも選択されいないエラー表示初期値
        $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
        //dd($cartData);
        //合計金額表示
        $TotalPrice = 0; //初期値0
        $count = count($cartData);
        for ($i = 0; $i < $count; $i++) {
            $t = $cartData[$i]['total'] * $cartData[$i]['price'];
            $TotalPrice = $TotalPrice + $t;
        }
        return view('SampleSite.pre-purchase-list', ['address'=>$address,'cartData' => $cartData, 'TotalPrice' => $TotalPrice, 'chkerrorMessage' => $chkerror_massage,'existingCardlist'=> $existingCardlist,'chooseNo'=>$chooseNo]);
    }

    //public function credit_register()//新規クレジットカード登録画面遷移
    //{
        //return view('SampleSite.credit-register', []);

    //}
    public function addNewCard(Request $request) //postだからRequest必要
    {
        $cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
        $TotalPrice = $this->calcTotalPrice($cartData);
        $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
        $chkerror_massage = ''; //未入力時の初期値
        $address = Auth::user();
        $user_id = Auth::user()->id;
        if (empty($request->number)&&empty($request->card_exp_year)&&empty($request->card_exp_month)&&empty($request->card_owner)) { //name='chk[]'が空ならchkerror_massageを表示
            $chkerror_massage = "「カード番号」を入力してください。
            「有効期限」を選択してください。
            「カードに記載された名前」を入力してください。";
            return view('SampleSite.credit-register', ['existingCardlist' => $existingCardlist, 'chkerrorMessage' => $chkerror_massage]);
        } else {
            $credit_data = [                                       
                'user_id' => $user_id,
                'number' => $request->number,
                'expire_y' => $request->card_exp_year,
                'expire_m' => $request->card_exp_month,
                'name' => $request->card_owner
                //save()メソッドを使う
            ];

            $data = new Credit();
            $data->fill($credit_data)->save();
            $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
            return view('SampleSite.pre-purchase-list', ['cartData' => $cartData,'TotalPrice' => $TotalPrice,'address' => $address, 'data' => $data, 'existingCardlist' => $existingCardlist, 'chkerrorMessage' => $chkerror_massage,]);
        }
    }
        public function chooseCard(Request $request)
    {
        //$chkerror_massage = ''; //未入力時の初期値
        //$cartData = $request->session()->get('cart-data', []); //最初はsession情報なしなのでnull　カート追加後ddで表示
        //$TotalPrice = $this->calcTotalPrice($cartData);
       // $address = Auth::user();

       // $data=$request->credit_id;
       // $existingCardlist = credit::all(); //$listはコレクションという型,配列と同じ扱いができる
        $chooseNo=$request->credit_id;
        //dd($chooseNo);
        return redirect()->route('pre_purchase', ['chooseNo' => $chooseNo]); 
        //return view('SampleSite.pre-purchase-list', ['cartData' => $cartData,'TotalPrice' => $TotalPrice,'chkerrorMessage' => $chkerror_massage,'data' => $data,'existingCardlist' => $existingCardlist,'chooseNo'=>$chooseNo,'address' => $address]); //'list'は名前なんでもいい、識別子

    }


    
}
