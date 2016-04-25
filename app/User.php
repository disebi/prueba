<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Role;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name',
        'email',
        'role_id',
        'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function staff(){
        return $this->hasOne('App\Staff');
    }



    public function getRoleListAttribute(){
        return $this->role()->lists('id');
    }

    public function hasAccess($name){
      $licenses=Role::find($this->role_id)->licenses()->lists('description');
      if (in_array($name, $licenses)) {
          return true;
      }  return false;

    }
}
