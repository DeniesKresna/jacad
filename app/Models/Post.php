<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 03 Jun 2020 15:34:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property int $author_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Post extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'title',
		'url',
		'content',
		'author_id'
	];

	public function author(){
		return $this->belongsTo('App\Models\User','author_id');
	}

	public function categories(){
		return $this->belongsToMany('App\Models\Category');
	}
}
