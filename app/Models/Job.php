<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 09 Nov 2020 00:24:17 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Job
 * 
 * @property int $id
 * @property int $company_id
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
 * @property int $view
 * @property int $read
 * @property int $verified
 * @property int $first_reader_id
 * @property int $verificator_id
 * @property int $creator_id
 * @property \Carbon\Carbon $expired
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Job extends Eloquent
{
	protected $casts = [
		'company_id' => 'int',
		'location_id' => 'int',
		'view' => 'int',
		'read' => 'int',
		'verified' => 'int',
		'first_reader_id' => 'int',
		'verificator_id' => 'int',
		'creator_id' => 'int'
	];

	protected $dates = [
		'expired'
	];

	protected $fillable = [
		'company_id',
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
		'view',
		'read',
		'verified',
		'first_reader_id',
		'verificator_id',
		'creator_id',
		'expired'
    ];
    
    public function company() {
        return $this->belongsTo('App\Models\Company', 'creator_id');
    }

    public function sectors() {
        return $this->belongsToMany('App\Models\Sector');
    }
}
