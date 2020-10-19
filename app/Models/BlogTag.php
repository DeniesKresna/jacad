<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:13 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BlogTag
 * 
 * @property int $id
 * @property int $tag_id
 * @property int $blog_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class BlogTag extends Eloquent
{
	protected $table = 'blog_tag';

	protected $casts = [
		'tag_id' => 'int',
		'blog_id' => 'int'
	];

	protected $fillable = [
		'tag_id',
		'blog_id'
	];
}
