<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Dec 2020 04:11:38 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Payment
 * 
 * @property int $id
 * @property string $amount
 * @property string $code
 * @property string $via
 * @property string $transaction_status
 * @property string $transaction_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Payment extends Eloquent
{
	protected $fillable = [
		'amount',
		'code',
		'via',
		'transaction_status',
		'transaction_id'
    ];
    
    public function periodCustomers() {
        return $this->hasMany('App\Models\AcademyPeriodCustomer');
    }
}
