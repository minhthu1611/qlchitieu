<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\DangkyRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\KhoanchiRequest;
use App\Http\Requests\ChitieuRequest;

use App\models\user;
use App\models\khoanchi;
use App\models\chitieungay;
use Auth;
use Validator;
use GuzzleHttp\Client;
use Carbon;
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
        $info=user::find(Auth::guard('user')->user()->id);
        return view('modules.uploadavatar', compact('info'));
    }
    public function Post_edit(EditRequest $request)
    {
        $info=user::find(Auth::guard('user')->user()->id);
        if($request->img && $request->img!=''){

            $file=$request->file('img');
            $name=$file->getClientOriginalName();
            $file->move(public_path('/avatar'),$name);
        
            $info->update([
                'hoten'=>$request->name,
                'tuoi'=>$request->namsinh,
                'diachi'=>$request->diachi,
                'thunhap'=>$request->thunhap,
                'avatar'=>$name
            ]);
            return redirect('trangchu')->with(['message'=>'Cập nhật thành công!']);
        }
        else 
        {
            $info->update([
                'hoten'=>$request->name,
                'tuoi'=>$request->namsinh,
                'diachi'=>$request->diachi,
                'thunhap'=>$request->thunhap,
            ]);
            return redirect('trangchu')->with(['message'=>'Cập nhật thành công!']);
        }
        
    }

    public function Get_themkhoanchi()
    {
        return view('modules.themkhoanchi');
    }
    public function Post_themkhoanchi(KhoanchiRequest $request)
    {
        $data=user::find(Auth::guard('user')->user()->id);
        if(intval($data->thunhap)<intval($request->sotien))
        {
            return redirect()->back()->with(['error'=>'Giá trị không được lớn hơn thu nhập của bạn']);
        }
        else{

            try{
                $user_id=Auth::guard('user')->user()->id;
                khoanchi::insert([
                    'tenkhoanchi'=> $request->tenkhoanchi,
                    'giatri'=>$request->sotien,
                    'batbuoc'=>1,
                    'user_id'=>$user_id,
                    'created_at'=>Carbon::now()
                ]);
                return redirect()->route('dskc')->with(['message'=>'Thêm thành công!']);
            }
            catch(\Illuminate\Database\QueryException $ex){ 
                return redirect()->back()->with(['message'=>'Không thể thêm!']);
            }               
        }
      
    }


    public function Get_dskhoanchi()
    {
        $data=khoanchi::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('modules.dskhoanchi',compact('data'));
    }

    public function Get_chitieungay(){
        return view('modules/themchitieu');
    }
    public function Post_chitieungay(ChitieuRequest $request){
        $data=user::find(Auth::guard('user')->user()->id);
        if(intval($data->thunhap)<intval($request->giatri))
        {
            return redirect()->back()->with(['error'=>'Giá trị không được lớn hơn thu nhập của bạn']);
        }
        else{

            try{
                // $user_id=Auth::guard('user')->user()->id;
                chitieungay::insert([
                    'chitieu'=> $request->chitieungay,
                    'giatri'=>$request->giatri,
                    'user_id'=>$data->id,
                    'created_at'=>Carbon::now()
                ]);
                return redirect()->route('tkct')->with(['message'=>'Thêm thành công!']);
            }
            catch(\Illuminate\Database\QueryException $ex){ 
                return redirect()->back()->with(['message'=>'Không thể thêm!']);
            }               
        }
    }
    public function Get_thongkechitieu()
    {
        $data=chitieungay::where('user_id',Auth::guard('user')->user()->id)->get();
        $info=user::find(Auth::guard('user')->user()->id);
        return view('modules.thongkechitieu',compact('data','info'));
    }
    // public function Get_api()
    // {
    //     $client = new Client([
    //         // Base URI is used with relative requests
    //         'base_uri' => 'http://phongkinhtecairang.com/',
    //         // You can set any number of default request options.
    //         'timeout'  => 20.0,
    //     ]);
    //     $response = $client->request('GET',"info/thuan");
    //         return $response->getBody(); //tra chuoi dc ne a
    //         // cai nay a ko biet r, cai loi no ko lay dc ket qua ben kia r, s chuoi thi no lay dc moi ac, them cai getcontent gi do vao thu xem s e thu r k dc a @@
    //     //chay lai cai route nay cho a coi thu do a  ben day goi request qua kia lay a
    //         // roi thang nay lay ve ah da
    //         // cai nay a chiu r da  v e kiem cai khac
    // }
    public function Post_ajax_delete_kc(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                khoanchi::find($request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }

    public function Post_ajax_delete_ct(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                chitieungay::find($request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }
}
