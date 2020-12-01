<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Oct 2020 13:04:14 +0700.
 */

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\PasswordReset; // Or the location that you store your notifications (this is default).
use Matrix\Functions;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $prev_login
 * @property \Carbon\Carbon $last_login
 * @property int $active
 * @property \Carbon\Carbon $dt_start
 * @property \Carbon\Carbon $dt_end
 * @property string $notification_emails
 * @property string $phone
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    
	protected $casts = [
		'active' => 'int'
	];

	protected $dates = [
		'prev_login',
		'last_login',
		'dt_start',
		'dt_end'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'username',
        'email',
        'phone',
        'address',
        'username',
		'password',
		'prev_login',
        'last_login',
        'type',
		'active',
		'dt_start',
		'dt_end',
		'notification_emails',
        'phone',
        'dt_start',
		'dt_end'
    ];
    
    /**
	* Send the password reset notification.
	*
	* @param  string  $token
	* @return void
	*/
	public function sendPasswordResetNotification($token)
	{
	    $this->notify(new PasswordReset($token));
	}

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
    
    public function job_applications() {
        return $this->belongsToMany('App\Models\Job', 'job_applications', 'applicant_id', 'job_id');
    }
}
