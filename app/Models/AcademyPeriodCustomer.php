<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Dec 2020 04:12:06 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AcademyPeriodCustomer
 * 
 * @property int $id
 * @property int $price
 * @property string $description
 * @property int $status
 * @property int $academy_period_id
 * @property int $customer_id
 * @property int $payment_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class AcademyPeriodCustomer extends Eloquent
{
	protected $table = 'academy_period_customer';

	protected $casts = [
		'price' => 'int',
		'status' => 'int',
		'academy_period_id' => 'int',
		'customer_id' => 'int',
		'payment_id' => 'int'
	];

	protected $fillable = [
		'price',
		'description',
		'status',
		'academy_period_id',
		'customer_id',
		'payment_id'
    ];
    
    public function academy_period() {
        return $this->belongsTo('App\Models\AcademyPeriod');
    }
}
