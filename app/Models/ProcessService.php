<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProcessService extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'process_service';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["service_request_id","status","details","team_id","assigned_date"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				details LIKE ? 
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
			"id", 
			"service_request_id", 
			"status", 
			"details", 
			"team_id", 
			"updated_at", 
			"assigned_date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id", 
			"service_request_id", 
			"status", 
			"details", 
			"team_id", 
			"updated_at", 
			"assigned_date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id", 
			"service_request_id", 
			"status", 
			"details", 
			"team_id", 
			"updated_at", 
			"assigned_date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id", 
			"service_request_id", 
			"status", 
			"details", 
			"team_id", 
			"updated_at", 
			"assigned_date" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id", 
			"service_request_id", 
			"status", 
			"details", 
			"team_id", 
			"assigned_date" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
