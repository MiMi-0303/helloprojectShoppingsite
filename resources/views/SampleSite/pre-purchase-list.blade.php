<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>

<body cz-shortcut-listen="true">
  @auth
  <table>
    <caption>支払いと発送方法</caption>
    <thead>
      <tr>
        <th>お届け先</th>
        <th>支払い方法</th>
      </tr>
    </thead>
    <tr>
      <td>{{$address->fullname}}様</td>
    </tr>

    <tr>
      <td>{{$address->phone_number}}</td>
      <td><select name="pay" id="select1">
          <option disabled selected> 選択してください</option>
          <option value="credit">クレジットカード</option>
          <option>銀行振込</option>
          <option value="conveni">コンビニ・郵便局等</option>
        </select>
      </td>
    </tr>
    <form method="post" action="" id="pageChange">
    @csrf
    <tr>
      <td>{{$address->address}}</td>
      <tf>{{$chooseNo}}</td>
      <td><select name="pay" disabled id="select2" onchange="CreditRegister(this)">
          <option data-group="" disabled>選択してください</option>
          @foreach($existingCardlist as $data)
          <option data-group="credit" value="">{{$data->number}}</option>
          @endforeach
          <option data-group="credit" value="other-card">その他カードを使う</option><!--ページ遷移してカード追加のページへ-->
          <option data-group="conveni" value="">セブンイレブン(前払)</option>
          <option data-group="conveni" value="">ローソン・郵便局ATM等(前払)</option>

        </select></td>
    </tr>
    </form>
    <tr>
      <td>{{$address->address2}}</td>
    </tr>
  </table>


  <table>
    <caption>ご注文商品</caption>
    <a>{{$chkerrorMessage}}</a>
    <form method="post" action="" id="delete2">
      @csrf
      <thead>
        <tr>
          <th>編集</th>
          <th>ID</th>
          <th>商品名</th>
          <th>価格</th>
          <th>個数</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartData as $key)
        <tr>
          <td><input type="checkbox" name="chk[]" value="{{$key['product_id']}}"></td>
          <td>{{$key['product_id']}}</td>
          <td>{{$key['name']}}</td>
          <td>{{$key['price']}}</td>
          <td>{{$key['total']}}</td>
        </tr>
        @endforeach
      </tbody>
    </form>
  </table>
  <p>ご購入金額：{{$TotalPrice}}</p>
  <a href="{{route('view_cart')}}">カート画面に戻る</a>
  <a href="javascript:pre_purchase_delete();">削除</a>


  <script>
    function pre_purchase_delete() {
      // console.log("hogehoge");
      const form = document.getElementById('delete2');
      console.log(form);
      form.action = "{{route('pre_purchase_delete')}}";
      form.submit();
    }

    //支払い方法のドロップダウンリスト選択
    document.querySelector("#select1").addEventListener("change", function() {
      var select1_valu = document.querySelectorAll("#select1 option")[this.selectedIndex].value;

      //querySelectorAllの返り値は配列,selectedIndex→選択されたら上から順に0,1,2と番号が格納される。
      console.log(select1_valu);
      var el2 = document.querySelector("#select2");
      console.log(el2);

      if (select1_valu === '') {
        el2.disabled = true;
      } else {
        document.querySelectorAll("#select2 option").forEach(function(elm, index) {
          //配列名.forEach( コールバック関数(要素の値, 要素のインデックス) )
          console.log(elm);
          if (select1_valu === elm.dataset.group) { //data-groupを指定したい場合はdataset.group　data-〇〇
            elm.style.display = 'inline';
          } else {
            elm.style.display = 'none';
          }
        });
        el2.disabled = false;
      }
    });

    //新規クレジットカード登録画面遷移
    function CreditRegister(obj) {
      var idx = obj.selectedIndex;
      console.log(idx);
      var value = obj.options[idx].value;
      if (value === "other-card") {
        const form =document.getElementById('pageChange');
      form.action="{{route('existingCard')}}";
      form.submit();
    } else {}
    }
  </script>
</body>
@endauth

</html>