<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:13 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Academy
 * 
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property float $rating
 * @property string $review
 * @property int $price
 * @property string $faq
 * @property string $learning_resources
 * @property string $learning_process
 * @property string $starting_time
 * @property string $platform
 * @property int $mentor_id
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Academy extends Eloquent
{
	protected $casts = [
		'rating' => 'float',
		'price' => 'int',
		'mentor_id' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'rating',
		'review',
		'price',
		'faq',
		'learning_resources',
		'learning_process',
		'starting_time',
		'platform',
		'mentor_id',
		'creator_id',
		'updater_id'
	];
}
