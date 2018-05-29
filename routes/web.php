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
    
    Route::group(['prefix' => 'khoan-chi-bat-buoc'], function () {
        Route::get('themkhoanchi',['as'=>'gtkc','uses'=>'Qlchitieu@Get_themkhoanchi']);
        Route::post('themkhoanchi',['as'=>'ptkc','uses'=>'Qlchitieu@Post_themkhoanchi']);
    
        Route::get('danh-sach-khoan-chi',['as'=>'dskc','uses'=>'Qlchitieu@Get_dskhoanchi']);
        Route::post('delete_kc',['as'=>'delete_kc','uses'=>'Qlchitieu@Post_ajax_delete_kc']); 
    });

    Route::group(['prefix' => 'chi-tieu'], function () {
        Route::get('them-chi-tieu-ngay',['as'=>'ctn','uses'=>'Qlchitieu@Get_chitieungay']);
        Route::post('them-chi-tieu-ngay',['as'=>'pctn','uses'=>'Qlchitieu@Post_chitieungay']);
        Route::get('thong-ke-chi-tieu',['as'=>'tkct','uses'=>'Qlchitieu@Get_thongkechitieu']);

        Route::post('delete_ct',['as'=>'delete_ct','uses'=>'Qlchitieu@Post_ajax_delete_ct']);
    });
   
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
Route::get('wtf/{id}', 'Qlchitieu@Get_api');

