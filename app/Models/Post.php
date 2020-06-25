<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jun 2020 14:40:16 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $title
 * @property string $image_url
 * @property string $image_path
 * @property string $url_title
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
		'image_url',
		'image_path',
		'url_title',
		'url',
		'content',
		'author_id'
	];

	public function categories(){
		return $this->belongsToMany("App\Models\Category");
	}

	public function author(){
		return $this->belongsTo("App\Models\User","author_id");
	}
}
