<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 08 Dec 2020 18:58:27 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MentoringType
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class MentoringType extends Eloquent
{
    protected $table = 'mentoring_types';
    
	protected $fillable = [
		'name'
	];
}
