<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 15 Nov 2020 16:01:06 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Blog
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property string $url_title
 * @property string $image_url
 * @property string $image_path
 * @property int $category_id
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
		'category_id' => 'int',
		'author_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'url',
		'url_title',
		'image_url',
		'image_path',
		'category_id',
		'author_id'
    ];
    
    public function author() {
		return $this->belongsTo("App\Models\User", 'author_id');
	}

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags() {
		return $this->belongsToMany("App\Models\Tag");
	}
}
