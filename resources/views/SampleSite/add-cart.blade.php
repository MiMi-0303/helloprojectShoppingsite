<!DOCTYPE html>
<html lang="ja">

<head>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body cz-shortcut-listen="true">
    @auth
    <h1>カートの中身</h1>
    <a>{{$chkerrorMessage}}</a>
    <table>
        <thead>
            <tr>
                <th>編集</th>
                <th>ID</th>
                <th>商品名</th>
                <th>価格</th>
                <th>個数</th>
            </tr>
        </thead>
        <form method="post" action="" id="delete">
            @csrf
            <tbody id="counter">
                @foreach($cartData as $key)
                <tr>
                    <td><input type="checkbox" name="chk[]" value="{{$key['product_id']}}"></td>
                    <td>{{$key['product_id']}}</td>
                    <td>{{$key['name']}}</td>
                    <td>{{$key['price']}}</td>
                    <td>
                        <input type="number" class="tatals" name="total_{{$key['product_id']}}" value="{{$key['total']}}" onchange="onChangeTotal({{$key['product_id']}},this.value)">
                        <input type="hidden" class="prices" name="price_{{$key['product_id']}}" value="{{$key['price']}}">
                    </td>
                </tr>
                @endforeach
                {{Auth::user()->name}}
            </tbody>
        </form>
    </table>
    <p>ご購入金額：<input type="text" disabled="disabled " id="TotalPrice" value="{{$TotalPrice}}"></p>
    <a href="{{route('site_product')}}">買い物を続ける</a><!--aタグを使っているのでget扱い-->
    <a href="javascript:purchase_delete();">削除</a>
    <a href="{{route('pre_purchase')}}">ご購入手続き</a>
    <script>
        function onChangeTotal(productId, chValue) {
            let TotalPrice = 0;
            let list = document.getElementById("counter");
            console.log(list);
            let count = document.querySelector('#counter').childElementCount;
            console.log(count);
            for (var i = 0; i < count; i++) {
                console.log(list.children[i]);
                let unitPrice = list.children[i].querySelector('input[name^="price_"]').value;
                console.log(unitPrice);
                let Value = list.children[i].querySelector('input[name^="total_"]').value;
                console.log(Value);
                TotalPrice = TotalPrice + unitPrice * Value;
            }
            console.log(TotalPrice);
            let element = document.getElementById('TotalPrice');
            element.value = TotalPrice;
            console.log(element);
            console.log(productId);
            $.ajax({
                type: "POST",
                url: "{{route('change_value')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    product_id: productId,
                    total: chValue,
                }
            }).done(function(msg) {
                alert("データ保存: " + msg);
            });
        }

        function purchase_delete() {
            // console.log("hogehoge");
            const form = document.getElementById('delete');
            console.log(form);
            form.action = "{{route('purchase_delete')}}";
            form.submit();
        }
    </script>

</body>
@endauth

</html>