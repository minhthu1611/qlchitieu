<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\DangkyRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\KhoanchiRequest;
use App\Http\Requests\ChitieuRequest;
use App\Http\Requests\ThunhapRequest;
use App\Http\Requests\ChangepasswordRequest;

use App\models\user;
use App\models\khoanchi;
use App\models\chitieungay;
use App\models\thunhapps;
use Auth;
use Validator;
use GuzzleHttp\Client;
use Carbon;
use DB;
use Hash;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
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
				return redirect()->route('gtkc');			}
		else
			{
				return redirect()->back()->with(['errormessage'=>'Email hoặc password không đúng!']);
			}
    }

    public function Get_trangchu(Request $request)
    {
        if($request->get('query') && $request->get('query')!='')
        {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'https://nongsancairang.com/api/product/'.$request->get('query'));
            $data= json_decode($res->getBody());
        }
        else
        {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'https://nongsancairang.com/api/product/100000');
            $data= json_decode($res->getBody());
        }
       
        return view('modules.dashboard',compact('data'));
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
        $money=khoanchi::where('user_id',Auth::guard('user')->user()->id)->sum('giatri');
        if(intval($data->thunhap)<intval($request->sotien)||intval($money)+intval($request->sotien)>intval($data->thunhap))
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
                    'ngaythang'=>date('Y-m'),
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


    public function Get_dskhoanchi(Request $request)
    {
        if($request->get('query') && $request->get('query')!=''){
            $day=$request->get('query');
            $data=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->get();
        }
        else if($request->get('query') && $request->get('query')==1)
        {
            $day=$request->get('query');
            $data=khoanchi::where('user_id',Auth::guard('user')->user()->id)->get();
        }
        else{
            $day='';
            $data=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.date('Y-m').'%')->get();
        }
           
        return view('modules.dskhoanchi',compact('data','day'));
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
                    'ngaythang'=>date('Y-m'),
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
    public function Get_thongkechitieu(Request $request)
    {
       if($request->get('query') && $request->get('query')!='')
       {
           $day=$request->get('query');
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->sum('giatri');
            $data=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->get();
            $money=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->sum('giatri');
       }
       else if($request->get('query') && $request->get('query')==1)
       {
            $day=$request->get('query');
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->sum('giatri');
            $data=chitieungay::where('user_id',Auth::guard('user')->user()->id)->get();
            $money=khoanchi::where('user_id',Auth::guard('user')->user()->id)->sum('giatri');
       }
       else
       {
           $day='';
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.date("Y-m").'%')->sum('giatri');
            $data=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.date("Y-m").'%')->get();
            $money=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.date("Y-m").'%')->sum('giatri');
       }
        
        $info=user::find(Auth::guard('user')->user()->id);
    
        $money_can_use=$info->thunhap+$tnps-$money;
        return view('modules.thongkechitieu',compact('data','info','money_can_use','day'));
    }
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

    public function Post_ajax_delete_nct(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                chitieungay::whereIn('id',$request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }

    public function Post_ajax_delete_nkc(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                khoanchi::whereIn('id',$request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }
    public function Get_changepassword()
    {
        return view('modules.changepassword');
    }
    public function Post_changepassword(ChangepasswordRequest $request)
    {
        
        if(!Hash::check($request->now_password, Auth::guard('user')->user()->password))
        {

            return redirect()->back()->with(['errorpassword'=>'Nhập mật khẩu cũ không đúng!']);
        }
        else 
        {
            $info=user::find(Auth::guard('user')->user()->id);
            $info->update([
                'password'=>bcrypt($request->password),
            ]);
            return redirect('trangchu')->with(['message'=>'Cập nhật thành công!']);
        }
    }
    public function Post_ajax_delete_user(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                user::find($request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }

    public function Post_ajax_delete_nuser(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                user::whereIn('id',$request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
           
        }
    }
    
    public function Get_money_used(Request $request)
    {
            $chihangthang=[];
            if($request->get('query') && $request->get('query')!='')
            {
                $day=$request->get('query');
                $chitieu=chitieungay::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->where('ngaythang',$request->get('query'))->get();
                $chibatbuoc=khoanchi::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->where('ngaythang',$request->get('query'))->get();
                $thunhaps=thunhapps::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->where('ngaythang',$request->get('query'))->get();
               
                foreach($chibatbuoc as $cbb){

                    $chihangthang[]=['ngaythang'=>$cbb->ngaythang,'tongchi'=>$cbb->sotien,'batbuoc'=>$cbb->sotien];
                }
                foreach($chitieu as $ct){
                    $t=-1;
                    foreach($chihangthang as $key=> $k){
                        if($ct->ngaythang==$k['ngaythang']){
                            $t=$key;
                            break;
                        }
                        
                    }
                    if($t>-1){
                        $chihangthang[$t]['tongchi']= intval($chihangthang[$t]['tongchi'])+intval($ct->sotien);
                        $chihangthang[$t]['phatsinh']=$ct->sotien;
                    }
                    else{
                        $chihangthang[]=['ngaythang'=>$ct->ngaythang,'tongchi'=>$ct->sotien,'phatsinh'=>$ct->sotien];
                    }
                }
                foreach($thunhaps as $tnps){
                    $t=-1;
                    foreach($chihangthang as $key=> $k){
                        if($tnps->ngaythang==$k['ngaythang']){
                            $t=$key;
                            break;
                        }
                        
                    }
                    if($t>-1){
                        $chihangthang[$t]['thunhapps']=$tnps->sotien;
                    }
                    else{
                        $chihangthang[]=['ngaythang'=>$tnps->ngaythang,'thunhapps'=>$tnps->sotien];
                    }
                }
            }
            else{
                $day='';
                $time=time();
               
                $date=[];
                for($i=0;$i<=12;$i++)
                {
                    $time=strtotime("-".$i."Months");
                    $date[]=date("Y-m",$time);
                }
                //dd($date);
                $chitieu=chitieungay::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
                $chibatbuoc=khoanchi::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
                $thunhaps=thunhapps::where('user_id',Auth::guard('user')->user()->id)
                ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
                //dd($thunhaps);

                    foreach($chibatbuoc as $cbb){

                        $chihangthang[]=['ngaythang'=>$cbb->ngaythang,'tongchi'=>$cbb->sotien,'batbuoc'=>$cbb->sotien];
                    }
                    foreach($chitieu as $ct){
                        $t=-1;
                        foreach($chihangthang as $key=> $k){
                            if($ct->ngaythang==$k['ngaythang']){
                                $t=$key;
                                break;
                            }
                            
                        }
                        if($t>-1){
                            $chihangthang[$t]['tongchi']= intval($chihangthang[$t]['tongchi'])+intval($ct->sotien);
                            $chihangthang[$t]['phatsinh']=$ct->sotien;
                        }
                        else{
                            $chihangthang[]=['ngaythang'=>$ct->ngaythang,'tongchi'=>$ct->sotien,'phatsinh'=>$ct->sotien];
                        }
                    }
                    foreach($thunhaps as $tnps){
                        $t=-1;
                        foreach($chihangthang as $key=> $k){
                            if($tnps->ngaythang==$k['ngaythang']){
                                $t=$key;
                                break;
                            }
                            
                        }
                        if($t>-1){
                            $chihangthang[$t]['thunhapps']=$tnps->sotien;
                        }
                        else{
                            $chihangthang[]=['ngaythang'=>$tnps->ngaythang,'thunhapps'=>$tnps->sotien];
                        }
                    }
            } 
            return view('modules.money_used',compact('chihangthang','day'));
    }

    public function chitieutheothang(Request $request){   
        if($request->get('query') && $request->get('query')!=''){
            $ctn=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();
            $kc=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();   
            $day=$request->get('query');
        }
        else
        {
            $ctn=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();
            $kc=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();  
            $day='';  
        }
        $qq=0;
        if(count($tnps)==0 && count($ctn)==0 && count($kc)==0)
        {
            $qq=1;
        }
        return view('modules/chitieutheothang', compact('ctn','kc','tnps','qq','day'));
    }

    public function Get_thu_nhap(){
        return view('modules/thunhapps');
    }
    public function Post_thu_nhap(ThunhapRequest $request){
        $data=user::find(Auth::guard('user')->user()->id);
            try{
                thunhapps::insert([
                    'tenthunhap'=> $request->tenthunhap,
                    'giatri'=>$request->giatri,
                    'ngaythang'=>date('Y-m'),
                    'user_id'=>$data->id,
                    'created_at'=>Carbon::now()
                ]);
                return redirect()->route('tktn')->with(['message'=>'Thêm thành công!']);
            }
            catch(\Illuminate\Database\QueryException $ex){ 
                return redirect()->back()->with(['message'=>'Không thể thêm!']);
            }                
    }
    public function Get_thong_ke_thu_nhap(Request $request){
        if($request->get('query') && $request->get('query')!='')
        {
            $day=$request->get('query');
            $data=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->get();
        }
        else if($request->get('query') && $request->get('query')==1)
        {
            $data=thunhapps::where('user_id',Auth::guard('user')->user()->id)->get();
        }
        else
        {
            $day='';
            $data=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang','like','%'.$request->get('query').'%')->get();
        }
        
            
        return view('modules.thongkethunhap', compact('data','day'));
    }
    public function Post_ajax_delete_tn(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                thunhapps::find($request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            }
        }
    }
    public function Post_ajax_delete_ntn(Request $request)
    {
        if($request->ajax())
        {
            try
            {
                thunhapps::whereIn('id',$request->id)->delete();
                return 'ok';
            }
            catch(\Illuminate\Database\QueryException $ex){ 
               return 'error';
            } 
        }
    }
    public function report()
    {
        $time=time();
               
        $date=[];
        for($i=0;$i<=12;$i++)
        {
            $time=strtotime("-".$i."Months");
            $date[]=date("Y-m",$time);
        }
        //dd($date);
        $chitieu=chitieungay::where('user_id',Auth::guard('user')->user()->id)
        ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
        $chibatbuoc=khoanchi::where('user_id',Auth::guard('user')->user()->id)
        ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
        $thunhaps=thunhapps::where('user_id',Auth::guard('user')->user()->id)
        ->groupBy('ngaythang')->select(DB::raw('sum(giatri) sotien'),'ngaythang')->whereIn('ngaythang',$date)->get();
        //dd($thunhaps);

            foreach($chibatbuoc as $cbb){

                $chihangthang[]=['ngaythang'=>$cbb->ngaythang,'tongchi'=>$cbb->sotien,'batbuoc'=>$cbb->sotien];
            }
            foreach($chitieu as $ct){
                $t=-1;
                foreach($chihangthang as $key=> $k){
                    if($ct->ngaythang==$k['ngaythang']){
                        $t=$key;
                        break;
                    }
                    
                }
                if($t>-1){
                    $chihangthang[$t]['tongchi']= intval($chihangthang[$t]['tongchi'])+intval($ct->sotien);
                    $chihangthang[$t]['phatsinh']=$ct->sotien;
                }
                else{
                    $chihangthang[]=['ngaythang'=>$ct->ngaythang,'tongchi'=>$ct->sotien,'phatsinh'=>$ct->sotien];
                }
            }
            foreach($thunhaps as $tnps){
                $t=-1;
                foreach($chihangthang as $key=> $k){
                    if($tnps->ngaythang==$k['ngaythang']){
                        $t=$key;
                        break;
                    }
                    
                }
                if($t>-1){
                    $chihangthang[$t]['thunhapps']=$tnps->sotien;
                }
                else{
                    $chihangthang[]=['ngaythang'=>$tnps->ngaythang,'thunhapps'=>$tnps->sotien];
                }
            }
        // dd($chihangthang);
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');
        $excel->getDefaultStyle()->getFont()->setSize(13);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $excel->getActiveSheet()->setTitle('Thống kê chi tiêu');
        $excel->getActiveSheet()->setCellValue('C1'  ,'      Thống Kê Chi Tiêu ');
        $excel->getActiveSheet()->setCellValue('C2'  ,'      '.date('m/Y',strtotime("-12 Months")).' - '.date('m/Y')); 
        $excel->getActiveSheet()->getStyle("C1")->getFont()->setSize(30);
        $excel->getActiveSheet()->getStyle("C2")->getFont()->setSize(30);
        $excel->getActiveSheet()->setCellValue('A3'  ,'Mã người dùng: 0'.Auth::guard('user')->user()->id);
        $excel->getActiveSheet()->setCellValue('A4'  ,'Tài khoản: '.Auth::guard('user')->user()->email);
        $excel->getActiveSheet()->setCellValue('A5'  ,'Họ tên: '.Auth::guard('user')->user()->hoten);
        $excel->getActiveSheet()->setCellValue('A6'  ,'Thu nhập hiện tại: '.number_format(Auth::guard('user')->user()->thunhap). ' đ');
        $row=8;
        $excel->getActiveSheet()->setCellValue('A'.$row  ,'STT');
        $excel->getActiveSheet()->setCellValue('B'.$row  ,'Tháng');
        $excel->getActiveSheet()->setCellValue('E'.$row  ,'Tổng chi tiêu');
        $excel->getActiveSheet()->setCellValue('C'.$row  ,'Khoản bắt buộc');
        $excel->getActiveSheet()->setCellValue('D'.$row  ,'Khoản phát sinh');
        $excel->getActiveSheet()->setCellValue('F'.$row  ,'Thu nhập thêm');
        $excel->getActiveSheet()->getStyle('A'.$row.':F'.$row.'')->getFont()->setBold(true);
  
        foreach($chihangthang as $key=>$value){
            $row++;
            $stt=$key+1;
            $excel->getActiveSheet()->setCellValue('A'.$row  ,$stt);
            $excel->getActiveSheet()->setCellValue('B'.$row  ,$value['ngaythang']);
            $excel->getActiveSheet()->setCellValue('E'.$row  ,isset($value['tongchi'])? number_format($value['tongchi']). ' đ': '0 đ');
            $excel->getActiveSheet()->setCellValue('C'.$row  ,isset($value['batbuoc'])? number_format($value['batbuoc']). ' đ': '0 đ');
            $excel->getActiveSheet()->setCellValue('D'.$row  ,isset($value['phatsinh'])? number_format($value['phatsinh']). ' đ': '0 đ');
            $excel->getActiveSheet()->setCellValue('F'.$row  ,isset($value['thunhapps'])? number_format($value['thunhapps']). ' đ': '0 đ');
            
        }
        $excel->getActiveSheet()
        ->getStyle('A8:F'.$row)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
      $excel->getActiveSheet()->getStyle("A8:F".$row)->applyFromArray($styleArray);

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="thongkechitieu.xls"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    }
    public function report2(Request $request){
        if($request->get('query') && $request->get('query')!=''){
            $ctn=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();
            $kc=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',$request->get('query'))->get();   
            $day=$request->get('query');
        }
        else
        {
            $ctn=chitieungay::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();
            $kc=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();
            $tnps=thunhapps::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();  
            $day=date('Y-m');
        }
        if(count($tnps)==0 && count($ctn)==0 && count($kc)==0)
        {
            return redirect()->back();
        }
        else{

            $excel = new PHPExcel();


            $excel->setActiveSheetIndex(0);
            
            $excel->getDefaultStyle()->getFont()->setName('Times New Roman');
            $excel->getDefaultStyle()->getFont()->setSize(13);
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $excel->getActiveSheet()->setTitle('Thống kê chi tiêu');
            $excel->getActiveSheet()->setCellValue('C1'  ,' Thống Kê Chi Tiêu ');
            $excel->getActiveSheet()->setCellValue('C2'  ,'      '.$day); 
            $excel->getActiveSheet()->getStyle("C1")->getFont()->setSize(30);
            $excel->getActiveSheet()->getStyle("C2")->getFont()->setSize(30);
            $excel->getActiveSheet()->setCellValue('A3'  ,'Mã người dùng: 0'.Auth::guard('user')->user()->id);
            $excel->getActiveSheet()->setCellValue('A4'  ,'Tài khoản: '.Auth::guard('user')->user()->email);
            $excel->getActiveSheet()->setCellValue('A5'  ,'Họ tên: '.Auth::guard('user')->user()->hoten);
            $excel->getActiveSheet()->setCellValue('A6'  ,'Thu nhập hiện tại: '.number_format(Auth::guard('user')->user()->thunhap). ' đ');
            $rowbegin=8;
            $row=$rowbegin;
           
            if(count($kc)>0){
                $row=$rowbegin+1;
                $rowstart=$row+1;
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'      Khoản chi bắt buộc');
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setBold(true);
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setSize(20);

                $row++;
                $excel->getActiveSheet()->setCellValue('A'.$row  ,'STT');
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'Tên chi tiêu');
                $excel->getActiveSheet()->setCellValue('C'.$row  ,'số tiền');
                $excel->getActiveSheet()->setCellValue('D'.$row  ,'Ngày');
                $excel->getActiveSheet()->getStyle('A'.$row.':C'.$row.'')->getFont()->setBold(true);
                foreach($kc as $key=>$val){
                    $row++;
                    $stt=$key+1;
                    $excel->getActiveSheet()->setCellValue('A'.$row  ,$stt);
                    $excel->getActiveSheet()->setCellValue('B'.$row  ,$val->tenkhoanchi);
                    $excel->getActiveSheet()->setCellValue('C'.$row  ,number_format($val->giatri));
                    $excel->getActiveSheet()->setCellValue('D'.$row  ,substr($val->created_at,0,strpos($val->created_at,' ')));
                }
                $excel->getActiveSheet()
                ->getStyle('A'.$rowbegin.':D'.$row)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $excel->getActiveSheet()->getStyle("A".$rowstart.":D".$row)->applyFromArray($styleArray);
            }
            //$rowbegin!=8? $rowbegin=$row+4:'';
            $row==$rowbegin? '':$rowbegin=$row+4;
            if(count($ctn)>0){
                $row=$rowbegin+1;
                $rowstart=$row+1;
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'       Khoản chi phát sinh');
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setBold(true);
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setSize(20);

                $row++;
                $excel->getActiveSheet()->setCellValue('A'.$row  ,'STT');
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'Tên chi tiêu');
                $excel->getActiveSheet()->setCellValue('C'.$row  ,'số tiền');
                $excel->getActiveSheet()->setCellValue('D'.$row  ,'Ngày');
                $excel->getActiveSheet()->getStyle('A'.$row.':C'.$row.'')->getFont()->setBold(true);
                foreach($ctn as $key=>$val){
                    $row++;
                    $stt=$key+1;
                    $excel->getActiveSheet()->setCellValue('A'.$row  ,$stt);
                    $excel->getActiveSheet()->setCellValue('B'.$row  ,$val->chitieu);
                    $excel->getActiveSheet()->setCellValue('C'.$row  ,number_format($val->giatri));
                    $excel->getActiveSheet()->setCellValue('D'.$row  ,substr($val->created_at,0,strpos($val->created_at,' ')));
                }
                $excel->getActiveSheet()
                ->getStyle('A'.$rowbegin.':D'.$row)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $excel->getActiveSheet()->getStyle("A".$rowstart.":D".$row)->applyFromArray($styleArray);
            }
            //$rowbegin!=8? $rowbegin=$row+4:'';
             $row==$rowbegin? '':$rowbegin=$row+4;
            if(count($tnps)>0){
                $row=$rowbegin+1;
                $rowstart=$row+1;
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'       Thu nhập thêm');
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setBold(true);
                $excel->getActiveSheet()->getStyle('B'.$row.'')->getFont()->setSize(20);

                $row++;
                $excel->getActiveSheet()->setCellValue('A'.$row  ,'STT');
                $excel->getActiveSheet()->setCellValue('B'.$row  ,'Tên thu nhập');
                $excel->getActiveSheet()->setCellValue('C'.$row  ,'số tiền');
                $excel->getActiveSheet()->setCellValue('D'.$row  ,'Ngày');
                $excel->getActiveSheet()->getStyle('A'.$row.':C'.$row.'')->getFont()->setBold(true);
                foreach($tnps as $key=>$val){
                    $row++;
                    $stt=$key+1;
                    $excel->getActiveSheet()->setCellValue('A'.$row  ,$stt);
                    $excel->getActiveSheet()->setCellValue('B'.$row  ,$val->tenthunhap);
                    $excel->getActiveSheet()->setCellValue('C'.$row  ,number_format($val->giatri));
                    $excel->getActiveSheet()->setCellValue('D'.$row  ,substr($val->created_at,0,strpos($val->created_at,' ')));
                }
                $excel->getActiveSheet()
                ->getStyle('A'.$rowbegin.':D'.$row)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $excel->getActiveSheet()->getStyle("A".$rowstart.":D".$row)->applyFromArray($styleArray);

            }
           

            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="thongkechitieuthang'.$day.'.xls"');
            PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
            

        }
    }
}
