<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class MemberList extends Authenticatable //Modelは頭が大文字　キャメルケースに準じる
{
    use HasFactory,HasApiTokens, Notifiable;
    public $timestamps = false;
    protected $table = 'member_lists';
    
    public function MemberInformation(){
        return $this->hasOne(MemberInformation::class,'user_id','id');//MemberInformation::class='App\Models\MemberInformation'
        //table名とキー名の頭が同じだった場合、例）Userテーブル,user_idは上記の,'user_id','id'のように記載不要。
        //今回はテーブル名が一致しないので必要だった
    }
}
