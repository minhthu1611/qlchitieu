<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class khoanchi extends Model
{
   //
	protected $table='khoanchi';
	protected $fillable=['id','tenkhoanchi','giatri','batbuoc','user_id'];
	protected $timestamps=true;
	public function user()
    {
    	return $this->belongsTo('App\models\user');
    }
    
}
