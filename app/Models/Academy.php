<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Dec 2020 01:21:43 +0700.
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
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
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

    public function periods() {
        return $this->hasMany('App\Models\AcademyPeriod');
    }
    
    public function active_period() {
        return $this->hasOne('App\Models\AcademyPeriod')->where('active', 1);
    }
}
