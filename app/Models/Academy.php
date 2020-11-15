<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Nov 2020 00:58:44 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Academy
 * 
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property int $price
 * @property string $sku
 * @property string $category
 * @property string $url
 * @property string $url_name
 * @property string $image_url
 * @property string $image_path
 * @property int $creator_id
 * @property int $updater_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Academy extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'price' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'desc',
		'price',
		'sku',
		'category',
		'url',
		'url_name',
		'image_url',
		'image_path',
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
