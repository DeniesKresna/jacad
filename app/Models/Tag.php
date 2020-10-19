<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $name
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Tag extends Eloquent
{
	protected $casts = [
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'updater_id'
    ];
    
    public function updater() {
		return $this->belongsTo('App\Models\User', 'updater_id');
	}
}
