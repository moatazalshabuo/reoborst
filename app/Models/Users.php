<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class Users extends Authenticatable 
{
	use Notifiable, HasApiTokens;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'userid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["fullname","phonenumber","usertype","password","img"];
	/**
     * Table fields which are not included in select statement
     *
     * @var array
     */
	protected $hidden = ['password', 'token'];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				fullname LIKE ?  OR 
				phonenumber LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype", 
			"img" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype", 
			"img" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype", 
			"img" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"userid", 
			"fullname", 
			"phonenumber", 
			"UserType AS usertype", 
			"img" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->fullname;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->userid;
	}
	public function UserPhoto(){
		return $this->img;
	}
}
