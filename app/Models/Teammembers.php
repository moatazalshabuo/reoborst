<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Teammembers extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'teammembers';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'memberid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["userid","teamid"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				MemberID LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"MemberID AS memberid", 
			"UserID AS userid", 
			"TeamID AS teamid" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"MemberID AS memberid", 
			"UserID AS userid", 
			"TeamID AS teamid" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"MemberID AS memberid", 
			"UserID AS userid", 
			"TeamID AS teamid" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"MemberID AS memberid", 
			"UserID AS userid", 
			"TeamID AS teamid" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"MemberID AS memberid", 
			"UserID AS userid", 
			"TeamID AS teamid" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
