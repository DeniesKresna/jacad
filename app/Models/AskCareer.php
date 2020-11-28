<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Nov 2020 14:19:02 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AskCareer
 * 
 * @property int $id
 * @property string $name
 * @property string $schedule
 * @property int $price
 * @property int $mentor_id
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class AskCareer extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'price' => 'int',
		'mentor_id' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'name',
		'schedule',
		'price',
		'mentor_id',
		'creator_id',
		'updater_id'
    ];
    
    public function mentor() {
        return $this->belongsTo('App\Models\Mentor');
    }
}
