<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 27 Dec 2020 14:02:45 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Coupon
 * 
 * @property int $id
 * @property string $code
 * @property string $type
 * @property int $cut
 * @property string $extra_variable
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Coupon extends Eloquent
{
	protected $casts = [
		'cut' => 'int'
	];

	protected $fillable = [
		'code',
		'type',
		'cut',
		'extra_variable',
		'description'
	];
}
