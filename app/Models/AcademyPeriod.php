<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Dec 2020 01:54:54 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AcademyPeriod
 * 
 * @property int $id
 * @property string $period
 * @property int $price
 * @property string $description
 * @property int $active
 * @property int $academy_id
 * @property int $creator_id
 * @property int $updater_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class AcademyPeriod extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'price' => 'int',
		'active' => 'int',
		'academy_id' => 'int',
		'creator_id' => 'int',
		'updater_id' => 'int'
	];

	protected $fillable = [
		'period',
		'price',
		'description',
		'active',
		'academy_id',
		'creator_id',
		'updater_id'
    ];
    
    public function creator() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function academy_class() {
        return $this->belongsTo('App\Models\Academy', 'academy_id');
    }

    public function period_customers() {
        return $this->belongsToMany('App\Models\User', 'academy_period_customer', 'academy_period_id', 'customer_id')
            ->withPivot(['price', 'description', 'status']);
    }
}
