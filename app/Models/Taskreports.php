<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Taskreports extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'taskreports';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'taskreportid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["reportid","teamid","status","description","notes"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				TaskReportID LIKE ?  OR 
				Description LIKE ?  OR 
				Notes LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"TaskReportID AS taskreportid", 
			"ReportID AS reportid", 
			"TeamID AS teamid", 
			"Status AS status", 
			"TaskDate AS taskdate", 
			"Description AS description", 
			"Notes AS notes" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"TaskReportID AS taskreportid", 
			"ReportID AS reportid", 
			"TeamID AS teamid", 
			"Status AS status", 
			"TaskDate AS taskdate", 
			"Description AS description", 
			"Notes AS notes" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"TaskReportID AS taskreportid", 
			"ReportID AS reportid", 
			"TeamID AS teamid", 
			"Status AS status", 
			"TaskDate AS taskdate", 
			"Description AS description", 
			"Notes AS notes" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"TaskReportID AS taskreportid", 
			"ReportID AS reportid", 
			"TeamID AS teamid", 
			"Status AS status", 
			"TaskDate AS taskdate", 
			"Description AS description", 
			"Notes AS notes" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"TaskReportID AS taskreportid", 
			"ReportID AS reportid", 
			"TeamID AS teamid", 
			"Status AS status", 
			"Description AS description", 
			"Notes AS notes" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
