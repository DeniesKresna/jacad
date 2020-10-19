<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JobSector
 * 
 * @property int $id
 * @property int $job_id
 * @property int $sector_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class JobSector extends Eloquent
{
	protected $table = 'job_sector';

	protected $casts = [
		'job_id' => 'int',
		'sector_id' => 'int'
	];

	protected $fillable = [
		'job_id',
		'sector_id'
	];
}
