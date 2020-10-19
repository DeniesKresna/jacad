<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 14 Oct 2020 15:01:41 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	protected $fillable = [
		'name'
    ];
    
    public function blogs() {
        $this->hasMany('App\Models\Blog');
    }
}
