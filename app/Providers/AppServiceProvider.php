<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\models\khoanchi;

use View;
use Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('header', function($view)
        {
            $error='';
           $check=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m'))->get();
           if(count($check)==0 && date('d')<6)
           {
               $error='error';
           }
           else if(count($check)==0 && date('d')>=6)
           {
               $time=time();
               $time=strtotime("-1 Months");
                $data=khoanchi::where('user_id',Auth::guard('user')->user()->id)->where('ngaythang',date('Y-m',$time))->get()->toArray();
                if(count($data)==0)
                {
                    $error='error';
                }
                else
                {
                    $ins=[];
                    foreach($data as $key=>$value)
                    {
                        // $data[$key]['ngaythang']=date('Y-m');
                        // $data[$key]['created_at']=Carbon::now();
                        $ins[]=['tenkhoanchi'=>$value['tenkhoanchi'],'giatri'=>$value['giatri'],'batbuoc'=>1,
                        'ngaythang'=>date('Y-m'),'user_id'=>Auth::guard('user')->user()->id,'created_at'=>Carbon::now()];
                       
                    }
                    khoanchi::insert($ins);
                }
           }
           else
           {
               $error='ok';
           }
           $view->with('error',$error);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
