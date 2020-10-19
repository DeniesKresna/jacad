<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:13 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Comment
 * 
 * @property int $id
 * @property string $email
 * @property string $content
 * @property int $post_id
 * @property int $banned
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Comment extends Eloquent
{
	protected $casts = [
		'post_id' => 'int',
		'banned' => 'int'
	];

	protected $fillable = [
		'email',
		'content',
		'post_id',
		'banned'
	];
}
