<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 18:34:58 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AskCareer
 * 
 * @property int $id
 * @property string $name
 * @property int $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class AskCareer extends Eloquent
{
	protected $casts = [
		'price' => 'int'
	];

	protected $fillable = [
		'name',
		'price'
	];
}
