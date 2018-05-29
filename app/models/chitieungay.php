<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class chitieungay extends Model
{
    //
    protected $table='chitieungay';
	protected $fillable=['id','chitieu','giatri','user_id','created_at','updated_at'];
	public $timestamps = true;
	public function user()
    {
    	return $this->belongsTo('App\models\user');
    }
}
