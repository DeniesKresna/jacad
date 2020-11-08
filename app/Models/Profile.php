<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 08 Nov 2020 21:09:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Profile
 * 
 * @property int $id
 * @property int $user_id
 * @property string $string
 * @property string $domicile
 * @property \Carbon\Carbon $date_of_birth
 * @property string $facebook_url
 * @property string $linkedin_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Profile extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $dates = [
		'date_of_birth'
	];

	protected $fillable = [
		'user_id',
		'string',
		'domicile',
		'date_of_birth',
		'facebook_url',
		'linkedin_url'
	];
}
