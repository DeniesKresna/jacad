<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 21 Nov 2020 09:14:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AcademyRegistrant
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $domicile
 * @property string $profession
 * @property string $jobhun_info
 * @property int $batch
 * @property int $academy_id
 * @property int $creator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class AcademyRegistrant extends Eloquent
{
	protected $casts = [
		'batch' => 'int',
		'academy_id' => 'int',
		'creator_id' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'domicile',
		'profession',
		'jobhun_info',
		'batch',
		'academy_id',
		'creator_id'
    ];
    
    public function academy() {
        return $this->hasOne('App\Models\Academy', 'id', 'academy_id');
    }
}
