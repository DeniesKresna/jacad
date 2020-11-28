<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 28 Nov 2020 00:50:01 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mentoring
 * 
 * @property int $id
 * @property string $spesific_topic
 * @property string $date
 * @property string $time
 * @property string $duration
 * @property string $jobhun_info
 * @property int $ask_career_id
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Mentoring extends Eloquent
{
	protected $table = 'mentoring';

	protected $casts = [
		'ask_career_id' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'spesific_topic',
		'date',
		'time',
		'duration',
		'jobhun_info',
		'ask_career_id',
		'creator_id',
		'updater_id'
    ];
    
    public function ask_career() {
        return $this->belongsTo('App\Models\AskCareer', 'ask_career_id')->with('mentor');
    }

    public function creator() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
}
