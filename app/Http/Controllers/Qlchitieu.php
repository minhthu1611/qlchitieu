<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\DangkyRequest;
use App\models\user;
use Auth;
use Validator;
use GuzzleHttp\Client;
class Qlchitieu extends Controller
{
    //
    public function Get_login()
    {
        if(Auth::guard('user')->check()){
            return redirect('trangchu');
        }
        else
            return view('Login');
    }
    public function Post_login(LoginRequest $request)
    {
        $auth= array('email'=>$request->username,'password'=>$request->pass);
        if(Auth::guard('user')->attempt($auth,false))
			{
				return redirect()->route('trangchu');			}
		else
			{
				return redirect()->back()->with(['errormessage'=>'Email hoặc password không đúng!']);
			}
    }

    public function Get_trangchu()
    {
        return view('modules.dashboard');
    }
    


    public function Post_dangky(DangkyRequest $request)
	{
        // var_dump(user::all());
		user::insert([
						'email'=>$request->email,
						'password'=>bcrypt($request->password),
                        'hoten'=>$request->name,
                        'gioitinh'=>$request->sex,
                        'tuoi'=>$request->namsinh,
                        'diachi'=>$request->address,
                        'thunhap'=>$request->thunhap,
                        'level'=>'1',
						]);
        return redirect()->route('glogin')->with(['message'=>'Đăng ký thành công!']);
    }
    public function get_dangky()
    {
        return view('Dangky-cl');
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('glogin');
    }
    public function Get_edit()
    {
        return view('modules.uploadavatar');
    }
    public function Get_api()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://phongkinhtecairang.com/',
            // You can set any number of default request options.
            'timeout'  => 20.0,
        ]);
        $response = $client->request('GET',"info/thuan");
            return $response->getBody(); //tra chuoi dc ne a
            // cai nay a ko biet r, cai loi no ko lay dc ket qua ben kia r, s chuoi thi no lay dc moi ac, them cai getcontent gi do vao thu xem s e thu r k dc a @@
        //chay lai cai route nay cho a coi thu do a  ben day goi request qua kia lay a
            // roi thang nay lay ve ah da
            // cai nay a chiu r da  v e kiem cai khac
    }
}
