<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 09 Nov 2020 00:39:14 +0700.
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
