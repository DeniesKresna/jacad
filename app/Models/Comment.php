<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Jun 2020 18:40:32 +0700.
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
