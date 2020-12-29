<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Dec 2020 14:22:39 +0700.
 */

namespace App\Models;

//use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property int $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'active' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'username',
		'email',
		'password',
		'phone',
		'active'
    ];
    
    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role_name) {
        foreach ($this->roles()->get() as $key => $role) {
            if ($role == $role_name) {
                return true;
            }
        }
        
        return false;
    }

    public function profile() {
        return $this->hasOne('App\Models\Profile', 'user_id', 'id');
    }
}
