<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RoleUser
 * 
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 *
 * @package App\Models
 */
class RoleUser extends Eloquent
{
	protected $table = 'role_user';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];
}
