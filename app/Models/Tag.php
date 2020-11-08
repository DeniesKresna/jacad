<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 08 Nov 2020 18:57:17 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $name
 * @property int $creator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Tag extends Eloquent
{
	protected $casts = [
		'creator_id' => 'int'
	];

	protected $fillable = [
		'name',
		'creator_id'
    ];
    
    public function creator() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
}
