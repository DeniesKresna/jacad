<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentAmbassador
 * 
 * @property int $id
 * @property string $email
 * @property string $name
 * @property int $age
 * @property string $address
 * @property string $university
 * @property string $faculty
 * @property string $major
 * @property string $phone
 * @property string $line_id
 * @property string $ig_link
 * @property string $linkedin_link
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class StudentAmbassador extends Eloquent
{
	protected $casts = [
		'age' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'email',
		'name',
		'age',
		'address',
		'university',
		'faculty',
		'major',
		'phone',
		'line_id',
		'ig_link',
		'linkedin_link',
		'status'
	];
}
