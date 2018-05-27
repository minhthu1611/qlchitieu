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
        if(Auth::guard('user')->check()){
            return redirect('trangchu');
        }
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
				return redirect()->back()->with(['message'=>'Email hoặc password không đúng!']);
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
						'password'=>bcrypt($request->pass),
                        'hoten'=>$request->hoten,
                        'gioitinh'=>$request->gt,
                        'tuoi'=>$request->tuoi,
                        'diachi'=>$request->diachi,
                        'thunhap'=>$request->thunhap,
                        'level'=>json_encode(['1'])
						]);
        return redirect()->route('trangchu');
    }
    public function get_dangky()
    {
        return view('dangky-cl');
    }
}
