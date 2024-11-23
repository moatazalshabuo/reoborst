<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Areas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'areas';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'areaid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["areaname","latitude","longitude"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				AreaID LIKE ?  OR 
				AreaName LIKE ? 
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
			"AreaID AS areaid", 
			"AreaName AS areaname", 
			"Latitude AS latitude", 
			"Longitude AS longitude" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"AreaID AS areaid", 
			"AreaName AS areaname", 
			"Latitude AS latitude", 
			"Longitude AS longitude" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"AreaID AS areaid", 
			"AreaName AS areaname", 
			"Latitude AS latitude", 
			"Longitude AS longitude" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"AreaID AS areaid", 
			"AreaName AS areaname", 
			"Latitude AS latitude", 
			"Longitude AS longitude" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"AreaName AS areaname", 
			"Latitude AS latitude", 
			"Longitude AS longitude", 
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
