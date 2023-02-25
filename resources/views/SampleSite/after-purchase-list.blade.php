<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>

<body cz-shortcut-listen="true">
@auth
<h1>購入一覧</h1>
@if(session('feedback.success'))
            <p>{{ session('feedback.success')}}</p>
        @endif
        @error('chk[]')
        <p style="color:red;">{{ $message }}</p>
        @enderror
<table>
<thead><tr><th>編集</th><th>ID</th><th>お名前</th><th>問合せ</th></tr></thead>
<tbody>
<form method="post" action="{{ route('Contactlist-delete') }}" id="change">
@csrf
@foreach($list as $data)
<tr>
<td><input type="checkbox" name="chk[]" value="{{$data->id}}"></td>
    <td>{{$data->id}}</td>
    <td>{{$data->fullname}}</td>
    <td>{{$data->question}}</td>
</tr>
@endforeach

</table>
<input type="submit" value="削除" name="delete">
<input type="button" value="表示" name="sub" onclick="display()">
{{Auth::user()->name}}
</form>
<a href="{{route('logout')}}">ログアウト</a>
<script> 
function display(){
        const form =document.getElementById('change');
        form.action ="{{ route('Contactid-view')}}";//action→送り先
        form.submit();//はじめてデータが送られる
    }

</script>
</body>
@endauth
</body>
</html>