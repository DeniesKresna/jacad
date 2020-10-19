<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserToken
 * 
 * @property int $id
 * @property \Carbon\Carbon $expired_time
 * @property \Carbon\Carbon $dt_added
 * @property string $token
 * @property int $user_id
 *
 * @package App\Models
 */
class UserToken extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $dates = [
		'expired_time',
		'dt_added'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'expired_time',
		'dt_added',
		'token',
		'user_id'
    ];
    
    public function user(){
		return $this->belongsTo('App\Models\User');
	}
}
