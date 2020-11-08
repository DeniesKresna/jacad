<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 08 Nov 2020 23:45:15 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sector
 * 
 * @property int $id
 * @property string $name
 * @property int $creator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Sector extends Eloquent
{
	protected $casts = [
		'creator_id' => 'int'
	];

	protected $fillable = [
		'name',
		'creator_id'
	];
}
