<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 08 Dec 2020 22:16:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Opening
 * 
 * @property int $id
 * @property string $service
 * @property string $content
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Opening extends Eloquent
{
	protected $table = 'opening';

	protected $casts = [
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'service',
		'content',
		'creator_id',
		'updater_id'
	];
}
