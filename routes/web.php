<?php

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
//tao la thu
//uk t biet m la thu r
Route::get('/',['as'=>'glogin','uses'=>'Qlchitieu@Get_login']);
Route::post('/',['as'=>'plogin','uses'=>'Qlchitieu@Post_login']);
Route::get('logout',['as'=>'logout','uses'=>'QLchitieu@logout']);
Route::get('trangchu',['as'=>'trangchu','uses'=>'Qlchitieu@Get_trangchu'])->middleware('admincheck:1');
Route::get('register',['as'=>'get_register','uses'=>'Qlchitieu@Get_dangky']);
Route::post('register',['as'=>'post_register','uses'=>'Qlchitieu@Post_dangky']);
Route::get('check',function(){
    return view('check');
});
Route::group(['prefix' => 'admin','middleware'=>'admincheck:0'], function () {
    Route::get('user',['as'=>'admin/user','uses'=>'Admin@get_user']);
});

Route::any('nn', function () {
    return view('fixInfoUser');
});

