<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:13 +0700.
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
    
    public function author() {
		return $this->belongsTo("App\Models\User", 'author_id');
	}

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function tags() {
		return $this->belongsToMany("App\Models\Tag");
	}
}
