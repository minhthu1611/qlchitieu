<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\DangkyRequest;
use App\models\user;
use Auth;
use Validator;
class Qlchitieu extends Controller
{
    //
    public function Get_login()
    {
        // if(Auth::guard('user')->check()){
        //     return redirect('trangchu');
        // }
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
        return view('dangky-cl');
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('glogin');
    }
}
