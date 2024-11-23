<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Teams extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'teams';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'teamid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["teamname"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				TeamID LIKE ?  OR 
				TeamName LIKE ? 
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
			"TeamID AS teamid", 
			"TeamName AS teamname" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"TeamID AS teamid", 
			"TeamName AS teamname" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"TeamID AS teamid", 
			"TeamName AS teamname" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"TeamID AS teamid", 
			"TeamName AS teamname" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"TeamID AS teamid", 
			"TeamName AS teamname" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
