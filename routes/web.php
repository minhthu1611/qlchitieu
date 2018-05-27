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

Route::get('/',['as'=>'glogin','uses'=>'Qlchitieu@Get_login']);
Route::post('/',['as'=>'plogin','uses'=>'Qlchitieu@Post_login']);
Route::get('dang-ky',['as'=>'dangky','uses'=>'Qlchitieu@get_dangky']);

Route::get('trangchu',['as'=>'trangchu','uses'=>'Qlchitieu@Get_trangchu']);

Route::get('dangky',['as'=>'getdk','uses'=>'Qlchitieu@Get_dangky']);
Route::post('dangky',['as'=>'postdk','uses'=>'Qlchitieu@Post_dangky']);
Route::get('check',function(){
    return view('check');
});

