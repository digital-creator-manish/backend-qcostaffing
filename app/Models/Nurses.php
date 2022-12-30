<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurses extends Model
{
    use HasFactory;
	protected $fillable = ['lname', 'fname', 'm_initial', 'maiden_name', 'social_security_number'];


	public function NurseDuty()
	{
		//return $this->hasMany('App\Library');

		return $this->hasMany(NurseDuty::class, 'nurse_id');
	}

}
