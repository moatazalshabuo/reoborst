<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Teamassignments extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'teamassignments';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'assignmentid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["teamid","startdate","enddate","areaid"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				AssignmentID LIKE ? 
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
			"AssignmentID AS assignmentid", 
			"TeamID AS teamid", 
			"StartDate AS startdate", 
			"EndDate AS enddate", 
			"AreaID AS areaid" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"AssignmentID AS assignmentid", 
			"TeamID AS teamid", 
			"StartDate AS startdate", 
			"EndDate AS enddate", 
			"AreaID AS areaid" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"AssignmentID AS assignmentid", 
			"TeamID AS teamid", 
			"StartDate AS startdate", 
			"EndDate AS enddate", 
			"AreaID AS areaid" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"AssignmentID AS assignmentid", 
			"TeamID AS teamid", 
			"StartDate AS startdate", 
			"EndDate AS enddate", 
			"AreaID AS areaid" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"AssignmentID AS assignmentid", 
			"TeamID AS teamid", 
			"StartDate AS startdate", 
			"EndDate AS enddate", 
			"AreaID AS areaid" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
