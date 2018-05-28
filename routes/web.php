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

Route::get('register',['as'=>'get_register','uses'=>'Qlchitieu@Get_dangky']);
Route::post('register',['as'=>'post_register','uses'=>'Qlchitieu@Post_dangky']);
Route::group(['middleware' => ['admincheck:1']], function () {
    Route::get('trangchu',['as'=>'trangchu','uses'=>'Qlchitieu@Get_trangchu']);
    
    Route::get('edit',['as'=>'edit','uses'=>'Qlchitieu@Get_edit']);
    Route::post('edit',['as'=>'edit','uses'=>'Qlchitieu@Post_edit']);

    Route::get('themkhoanchi',['as'=>'gtkc','uses'=>'Qlchitieu@Get_themkhoanchi']);
    Route::post('themkhoanchi',['as'=>'ptkc','uses'=>'Qlchitieu@Post_themkhoanchi']);
});
Route::get('check',function(){
    return view('check');
});
Route::group(['prefix' => 'admin','middleware'=>'admincheck:0'], function () {
    Route::get('user',['as'=>'admin/user','uses'=>'Admin@get_user']);
});
Route::get('checked', function () {
    return view('api');
});
