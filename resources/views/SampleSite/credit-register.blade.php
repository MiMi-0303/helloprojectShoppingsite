<!DOCTYPE html>
<html lang="ja">

<head>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>


<body cz-shortcut-listen="true">
    @auth<!--bodyタグ内にauth入れる-->

    <h1>支払い方法の選択</h1>
    <p>カード</p>
    <p style="color:red;">{{$chkerrorMessage}}</p>
    <form method="post" action="" id="chooseCard">
        @csrf
        <table>
            <caption>登録済みのカード</caption>
            <tr class="">
                <th></th>
                <th></th>
                <th>番号</th>
                <th>年</th>
                <th>月</th>
                <th>カードに記載された名前</th>
            </tr>

            @foreach($existingCardlist as $data)
            <tr class="existingCard">
                <!--送れるのはinputタグかセレクトタグ-->
                <th scope="col" class="existingCard"><input type="radio" name='credit_id' value='{{$data->id}}' class="toggle"></th>
                <th scope="col" class="existingCard" name="id">{{$data->id}}</th> 
                <th scope="col" class="existingCard" name="number">{{$data->number}}</th>
                <th scope="col" class="existingCard" name="expire_y">{{$data->expire_y}}</th>
                <th scope="col" class="existingCard" name="expire_m">{{$data->expire_m}}</th>
                <th scope="col" class="existingCard" name="name">{{$data->name}}</th>
            </tr>
            @endforeach
        </table>
        <div class="form_input_item form_input_item--cardSubmit">
            <div class="form_label"></div>
            <div class="form_content">
                <input type="button" class="text-button" value="カードを選択する" onclick="chooseCard()">
            </div>
            <div class="c-b"></div>
        </div>




        <div class="blue_box">
            <input type="radio" name='chk[]' value="new" class="toggle" checked="checked">
            <label class="Label">新しくカードを追加する</label>

            <div class="content">
                <input type="text" name="number" placeholder="0000 0000 0000 000">
                <div class="form_input_item form_input_item--cardExpire">
                    <div class="form_label">
                        有効期限
                    </div>
                    <div class="form_content">
                        <div class="container__card_exp_month">
                            <select id="card_exp_month" name="card_exp_month">
                                <option value="">月
                                </option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="container__card_exp_year">
                            <select id="card_exp_year" name="card_exp_year">
                                <option value="">年</option>
                                @for($i=date('Y');$i<date('Y')+4;$i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form_input_item form_input_item--cardName">
                    <div class="form_label">
                        カードに記載された名前
                    </div>
                    <div class="form_content">
                        <input type="text" name="card_owner" size="20" maxlength="42" placeholder="TARO RAKUTEN">
                    </div>
                    <div class="c-b"></div>
                </div>
                <div class="form_input_item form_input_item--cardSubmit">
                    <div class="form_label"></div>
                    <div class="form_content">
                        <input type="button" value="追加" onclick="addNewCard()">
                    </div>
                    <div class="c-b"></div>
                </div>

            </div>

        </div>


    </form>
    <script>
        function chooseCard() {
            const form = document.getElementById('chooseCard');
            form.action = "{{route('chooseCard')}}";
            form.submit();
        }

        function addNewCard() {
            const form = document.getElementById('addNewCard');
            form.action = "{{route('addNewCard')}}";
            form.submit();
        }
    </script>
    @endauth
</body>

</html>