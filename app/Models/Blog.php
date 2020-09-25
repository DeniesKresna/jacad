<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 25 Sep 2020 12:01:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Blog
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
class Blog extends Eloquent
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
    
    public function tags() {
		return $this->belongsToMany("App\Models\Tag");
	}

	public function author() {
		return $this->belongsTo("App\Models\User", "author_id");
	}
}
