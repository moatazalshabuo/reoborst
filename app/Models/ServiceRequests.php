<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ServiceRequests extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'service_requests';
	

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
	protected $fillable = ["user_id","service_id","lat","lan","count","cost","status"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				lat LIKE ?  OR 
				lan LIKE ? 
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
			"id", 
			"user_id", 
			"service_id", 
			"lat", 
			"lan", 
			"count", 
			"cost", 
			"status", 
			"created_at", 
			"updated_at" 
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
			"user_id", 
			"service_id", 
			"lat", 
			"lan", 
			"count", 
			"cost", 
			"status", 
			"created_at", 
			"updated_at" 
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
			"user_id", 
			"service_id", 
			"lat", 
			"lan", 
			"count", 
			"cost", 
			"status", 
			"created_at", 
			"updated_at" 
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
			"user_id", 
			"service_id", 
			"lat", 
			"lan", 
			"count", 
			"cost", 
			"status", 
			"created_at", 
			"updated_at" 
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
			"user_id", 
			"service_id", 
			"lat", 
			"lan", 
			"count", 
			"cost", 
			"status" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
