<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login',[\App\Http\Controllers\IndexController::class,'login'])->name('login');//最初ページ表示させたとき
Route::post('/login',[\App\Http\Controllers\IndexController::class,'login'])->name('login');//formでsubmitしたときに送られる
Route::get('/logout',[\App\Http\Controllers\IndexController::class,'logout'])->name('logout');
//Route::post('/',[\App\Http\Controllers\AuthController::class,'auth'])->name('task15_auth');
//Route::get('/',[\App\Http\Controllers\Contact_listController::class,'Contact_list'])->name('Contactlist-view')->middleware('auth');
Route::post('/id',[\App\Http\Controllers\Contact_listController::class,'Contact_id'])->name('Contactid-view');
Route::post('/delete',[\App\Http\Controllers\Contact_listController::class,'Contact_delete'])->name('Contactlist-delete');

//product-site
Route::get('/login-site',[\App\Http\Controllers\SampleSite\LoginController::class,'login'])->name('site_login');//最初ページ表示させたとき
Route::post('/login-site',[\App\Http\Controllers\SampleSite\LoginController::class,'login'])->name('site_login');//formでsubmitしたときに送られる
Route::get('/',[\App\Http\Controllers\SampleSite\ViewController::class,'site_product'])->name('site_product')->middleware('auth');
Route::get('/logout-site',[\App\Http\Controllers\SampleSite\LoginController::class,'logout'])->name('site_logout');
Route::post('/add-cart',[\App\Http\Controllers\SampleSite\ViewController::class,'add_cart'])->name('add_cart')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::get('/view-cart',[\App\Http\Controllers\SampleSite\ViewController::class,'view_cart'])->name('view_cart')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/view-cart',[\App\Http\Controllers\SampleSite\ViewController::class,'view_cart'])->name('view_cart')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::get('/pre-purchase',[\App\Http\Controllers\SampleSite\ViewController::class,'pre_purchase'])->name('pre_purchase')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/change-value',[\App\Http\Controllers\SampleSite\ViewController::class,'change_value'])->name('change_value')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/purchase-delete',[\App\Http\Controllers\SampleSite\ViewController::class,'purchase_delete'])->name('purchase_delete')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/pre-purchase-delete',[\App\Http\Controllers\SampleSite\ViewController::class,'pre_purchase_delete'])->name('pre_purchase_delete')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/addNewCard',[\App\Http\Controllers\SampleSite\ViewController::class,'addNewCard'])->name('addNewCard')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/chooseCard',[\App\Http\Controllers\SampleSite\ViewController::class,'chooseCard'])->name('chooseCard')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。
Route::post('/credit',[\App\Http\Controllers\SampleSite\CreditController::class,'existingCard'])->name('existingCard')->middleware('auth');//ミドルウェア→カート追加はログイン時のみ可の為。




