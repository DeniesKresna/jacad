<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PasswordReset
 * 
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class PasswordReset extends Eloquent
{
	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'email',
		'token'
	];
}
