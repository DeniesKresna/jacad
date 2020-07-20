<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 02 Jul 2020 15:19:03 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $name
 * @property string $tagline
 * @property string $information
 * @property string $logo_url
 * @property string $logo_path
 * @property string $address
 * @property string $site_url
 * @property string $phone
 * @property string $email
 * @property string $employee_amount
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Company extends Eloquent
{
	protected $casts = [
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'tagline',
		'information',
		'logo_url',
		'logo_path',
		'address',
		'site_url',
		'phone',
		'email',
		'employee_amount',
		'updater_id'
	];

	public function jobs(){
		return $this->hasMany('App\Models\Job');
	}
}
