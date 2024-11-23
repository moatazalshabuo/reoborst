<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tasktype extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'tasktype';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'tasktypeid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["taskname","taskdescription","taskprice"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				TaskName LIKE ?  OR 
				TaskDescription LIKE ? 
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
			"TaskName AS taskname", 
			"TaskDescription AS taskdescription", 
			"TaskPrice AS taskprice", 
			"TaskTypeID AS tasktypeid" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"TaskName AS taskname", 
			"TaskDescription AS taskdescription", 
			"TaskPrice AS taskprice", 
			"TaskTypeID AS tasktypeid" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"TaskTypeID AS tasktypeid", 
			"TaskName AS taskname", 
			"TaskDescription AS taskdescription", 
			"TaskPrice AS taskprice" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"TaskTypeID AS tasktypeid", 
			"TaskName AS taskname", 
			"TaskDescription AS taskdescription", 
			"TaskPrice AS taskprice" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"TaskTypeID AS tasktypeid", 
			"TaskName AS taskname", 
			"TaskDescription AS taskdescription", 
			"TaskPrice AS taskprice" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
