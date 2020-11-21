<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 20 Nov 2020 20:40:11 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Job
 * 
 * @property int $id
 * @property string $position
 * @property string $type
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
 * @property \Carbon\Carbon $expired
 * @property int $location_id
 * @property int $verificator_id
 * @property int $creator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Job extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'view' => 'int',
		'read' => 'int',
		'verified' => 'int',
		'first_reader_id' => 'int',
		'location_id' => 'int',
		'verificator_id' => 'int',
		'creator_id' => 'int'
	];

	protected $dates = [
		'expired'
	];

	protected $fillable = [
		'position',
		'type',
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
		'expired',
		'location_id',
		'verificator_id',
		'creator_id'
    ];
    
    public function company() {
        return $this->belongsTo('App\Models\Company', 'creator_id');
    }
    
    public function location() {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }

    public function sectors() {
        return $this->belongsToMany('App\Models\Sector');
    }

    public function applicants() {
        return $this->belongsToMany('App\Models\User', 'job_applications', 'job_id', 'applicant_id');
    }   

    public function scopePosition($query, $position) {
        return $query->where('position', 'like', '%'.$position.'%');
    }
}
