<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jun 2020 19:29:41 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Media
 * 
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $url
 * @property string $path
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Media extends Eloquent
{
	protected $table = 'medias';

	protected $casts = [
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'type',
		'url',
		'path',
		'updater_id'
	];
}
