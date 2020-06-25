<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jun 2020 14:41:05 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sector
 * 
 * @property int $id
 * @property string $name
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Sector extends Eloquent
{
	protected $casts = [
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'updater_id'
	];
}
