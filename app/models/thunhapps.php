<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class thunhapps extends Model
{
    protected $table='thunhapps';
	protected $fillable=['id','tenthunhap','giatri','ngaythang','user_id','created_at','updated_at'];
	public $timestamps = true;
	public function user()
    {
    	return $this->belongsTo('App\models\user');
    }
}
