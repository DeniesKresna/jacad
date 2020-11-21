<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 20 Nov 2020 22:55:26 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AcademyTag
 * 
 * @property int $id
 * @property int $academy_id
 * @property int $tag_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class AcademyTag extends Eloquent
{
	protected $table = 'academy_tag';

	protected $casts = [
		'academy_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'academy_id',
		'tag_id'
	];
}
