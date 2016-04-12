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

    public function getFullName($user_id){

        $staff = $this->getStaffFromUser($user_id);
        return $staff->first()->name. ' '.$staff->first()->last_name;
    }

    public function getPosition($user_id){
        $staff = $this->getStaffFromUser($user_id);
        return $staff->position->description;
    }

    public function getBranch($user_id){
        $staff = $this->getStaffFromUser($user_id);
        return $staff->branch->description;
    }

    public function getBranchId($user_id){
        $staff = $this->getStaffFromUser($user_id);
        return $staff->branch_id;
    }

    public function getStaffId($user_id){
        $staff = $this->getStaffFromUser($user_id);
        return $staff->id;
    }

    public function getStaffFromUser($user_id)
    {   if($user_id==null){$user_id=$this->id;}
        $staff = Staff::where('user_id', '=', $user_id)->first();
        return $staff;
    }

}
