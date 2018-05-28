<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\user;

class Admin extends Controller
{
    public function get_user()
    {
        $data=user::where('level','<>','0')->get();
     
        return view('modules.admin-user',compact('data'));
    }
}
