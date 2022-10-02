<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\PseudoTypes\True_;
use PhpOption\None;
use \Exception;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'pic',
        'phone',
        'details',
        'region_id',
        'password',
    ];

    protected $attributes = [
        'pic' => '',
        'details' => -1,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        if( Hash::needsRehash($password) ) {
            $value = Hash::make($password);
        }
        $this->attributes['password'] = $value;
    }

    public function isEmailVerified()
    {
        if($this->email_verified_at != null){
            return True;
        }else{
            return False;
        }
    }

    public function isUserHasPic(){
        if($this->pic == ''){
            return false;
        }
        return true;
    }

    public function getRegionName(){
        return Region::find($this->region_id)->name;
    }

    public function getDetails(){
        switch ($this->role) {
            case 'student':
                return Student::find($this->details);
                break;
            case 'university':
                return University::find($this->details);
                break;
            case 'organization':
                return Organization::find($this->details);
                break;
        }
        return false;
    }

    function getResume(){
        if($this->role == 'student'){
            $resume = new Resume();
            if(Resume::where('user_id', $this->id)->count() > 0){
                $resume = Resume::where('user_id', $this->id)->get()[0];
            }
            return $resume;
        }
        return abort(403, 'Unauthorized action.');
    }

    function getAge(){
	    try{
		if($this->role == 'student'){
            		$byear = intval(explode(".", $this->getDetails()->bday)[2]);
            		$cy = intval(date("Y"));
            		return $this->yearTextArg($cy - $byear);
        	}
	    }catch(Exception $e){
		$this->delete();
	    }
        return -1;
    }

    function getAgeStr(){
	try{    
	 if($this->role == 'student'){
	    try{	 
	      $byear = intval(explode(".", $this->getDetails()->bday)[2]);
	    }catch(Exception $e){
              $this->delete();
            }
	    $cy = intval(date("Y"));
            return ($cy - $byear) . ' ' . $this->yearTextArg($cy - $byear);
	 }
	}catch(Exception $e){
            $this->delete();
        }
        return -1;
    }

    public static function yearTextArg($year) {
        $year = abs($year);
        $t1 = $year % 10;
        $t2 = $year % 100;
        return ($t1 == 1 && $t2 != 11 ? "год" : ($t1 >= 2 && $t1 <= 4 && ($t2 < 10 || $t2 >= 20) ? "года" : "лет"));
    }

    function isResumeExist(){
        if($this->role == 'student'){
            if(Resume::where('user_id', $this->id)->count() > 0){
                return true;
            }
        }
        return false;
    }

    function getNotifications(){
        if(Auth::user()->role == 'student'){
            $notifications = 0;
            $notifications += $this->getDetails()->getResponses();
            return $notifications;
        }
        return 0;
    }
}
