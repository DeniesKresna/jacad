<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Dec 2020 13:24:01 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mentor
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $linkedIn_url
 * @property string $url_name
 * @property string $url
 * @property string $image_url
 * @property string $image_path
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Mentor extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'creator_id' => 'int',
		'updater_id' => 'int'
	];
    
	protected $fillable = [
		'name',
		'description',
		'linkedIn_url',
		'url_name',
		'url',
		'image_url',
		'image_path',
		'creator_id',
		'updater_id'
	];
}
