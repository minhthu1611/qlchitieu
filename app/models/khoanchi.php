<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class khoanchi extends Model
{
   //
	protected $table='khoanchi';
	protected $fillable=['id','tenkhoanchi','giatri','batbuoc','user_id','created_at','updated_at'];
	//public $timestamps=false;
	public $timestamps = true;
	public function user()
    {
    	return $this->belongsTo('App\models\user');
    }
    
}
