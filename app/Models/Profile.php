<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Nov 2020 21:11:23 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Profile
 * 
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property string $domicile
 * @property \Carbon\Carbon $birth_date
 * @property string $facebook_url
 * @property string $linkedIn_url
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
		'birth_date'
	];

	protected $fillable = [
		'user_id',
		'description',
		'domicile',
		'birth_date',
		'facebook_url',
		'linkedIn_url'
	];
}
