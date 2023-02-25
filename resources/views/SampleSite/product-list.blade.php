<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body cz-shortcut-listen="true">
    @auth
    <h1>商品リスト</h1>
    @if(session('feedback.success'))
    <p>{{ session('feedback.success')}}</p>
    @endif
    <p style="color:red;">{{$chkerrorMessage}}</p>
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
        <tbody>
            <form method="post" action="" id="change">
                @csrf
                @foreach($list as $data)
                <tr>
                    <td><input type="checkbox" name="chk[]" value="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}<input type="hidden" name="p-name[{{$data->id}}]" value="{{$data->name}}"></td>
                    <td>{{$data->price}}<input type="hidden" name="price[{{$data->id}}]" value="{{$data->price}}"></td>
                    <td><input type="number" value="1" min="1" max="10" step="1" name="value[{{$data->id}}]"></td>
                </tr>
                @endforeach
        </tbody>

    </table>
    <input type="button" value="カートに追加" name="push-cart" onclick="add_cart()">
    <input type="button" value="カートを表示" name="sub" onclick="view_cart()">
    {{Auth::user()->name}}
    </form>
    <a href="{{route('site_logout')}}">ログアウト</a>
    <script>
        function view_cart() {
            const form = document.getElementById('change');
            form.action = "{{ route('view_cart')}}"; //action→送り先
            form.submit(); //はじめてデータが送られる
        }

        function add_cart() {
            const form = document.getElementById('change');
            form.action = "{{route('add_cart')}}";
            form.submit();
        }
    </script>
</body>
@endauth

</html>