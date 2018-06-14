<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class user extends Authenticatable
{
    protected $table = 'user';
    protected $fillable=['id','email','password','hoten','gioitinh','tuoi','diachi','thunhap','level','avatar'];
	public $timestamps=true;
	public function khoanchi()
    {
    	return $this->hasMany('App\models\khoanchi');
    }
    public function chitieungay()
    {
    	return $this->hasMany('App\models\chitieungay');
    }
}
