<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>
    <h1>ログイン画面</h1>
    <img src="{{ asset('img/officialshop.jpg') }}" alt="">
    <form action="{{ route('site_login')}}" method="post">
        @csrf
        <div class="err_msg" style="color:#FF0000">{{$loginfailed}}</div>
        @error('password')
        <div class="err_msg" style="color:#FF0000">{{$message}}</div>@enderror
        <label for=""><span>パスワード(半角英数字6文字以上255文字以内)</span>
      <br>
        <input type="text" name="password"><br>
        @error('email')
        <div class="err_msg" style="color:#FF0000">{{$message}}</div>
        @enderror
        <label for=""><span>メールアドレス</span>
        <br>
  <input type="text" name="email"><br>
        <input type="submit" value="ログイン">
    </form>
    </body>
</html>