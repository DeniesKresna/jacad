<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 02 Jul 2020 15:18:43 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Job
 * 
 * @property int $id
 * @property string $position
 * @property string $type
 * @property int $location_id
 * @property string $job_desc
 * @property string $work_time
 * @property string $dress_style
 * @property string $language
 * @property string $facility
 * @property string $salary
 * @property string $how_to_send
 * @property string $process_time
 * @property string $transfer_url
 * @property string $transfer_path
 * @property string $poster_url
 * @property string $poster_path
 * @property string $jobhun_info
 * @property int $company_id
 * @property string $view
 * @property int $read
 * @property int $first_reader_id
 * @property int $creator_id
 * @property \Carbon\Carbon $expired
 * @property int $verificator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Job extends Eloquent
{
	protected $casts = [
		'location_id' => 'int',
		'company_id' => 'int',
		'read' => 'int',
		'first_reader_id' => 'int',
		'creator_id' => 'int',
		'verificator_id' => 'int'
	];

	protected $dates = [
		'expired'
	];

	protected $fillable = [
		'position',
		'type',
		'location_id',
		'job_desc',
		'work_time',
		'dress_style',
		'language',
		'facility',
		'salary',
		'how_to_send',
		'process_time',
		'transfer_url',
		'transfer_path',
		'poster_url',
		'poster_path',
		'jobhun_info',
		'company_id',
		'view',
		'read',
		'first_reader_id',
		'creator_id',
		'expired',
		'verificator_id'
	];
    
	public function company() {
		return $this->belongsTo('App\Models\Company', 'creator_id');
	}
}
