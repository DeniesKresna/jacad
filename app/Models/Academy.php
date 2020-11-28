<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 25 Nov 2020 19:48:11 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Academy
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property string $category
 * @property string $url
 * @property string $url_name
 * @property string $image_url
 * @property string $image_path
 * @property int $batch
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Academy extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'price' => 'int',
		'batch' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'category',
		'url',
		'url_name',
		'image_url',
		'image_path',
		'batch',
		'creator_id',
		'updater_id'
    ];
    
    public function creator() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
    
    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}
