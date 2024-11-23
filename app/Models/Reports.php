<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Reports extends Model
{


	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'reports';


	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'reportid';


	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["description","tasktype","lat","lng",'status'];


	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record
		$search_condition = '(
				Description LIKE ?  OR
				lat LIKE ?  OR
				lng LIKE ?
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
			"ReportID AS reportid",
			"Description AS description",
			"ReportDate AS reportdate",
			"TaskType AS tasktype",
			"lat",
            'status',
			"lng"
		];
	}


	/**
     * return exportList page fields of the model.
     *
     * @return array
     */
	public static function exportListFields(){
		return [
			"ReportID AS reportid",
			"Description AS description",
			"ReportDate AS reportdate",
			"TaskType AS tasktype",
			"lat",
            'status',
			"lng"
		];
	}


	/**
     * return view page fields of the model.
     *
     * @return array
     */
	public static function viewFields(){
		return [
			"ReportID AS reportid",
			"Description AS description",
			"ReportDate AS reportdate",
			"TaskType AS tasktype",
			"lat",
            'status',
			"lng"
		];
	}


	/**
     * return exportView page fields of the model.
     *
     * @return array
     */
	public static function exportViewFields(){
		return [
			"ReportID AS reportid",
			"Description AS description",
			"ReportDate AS reportdate",
			"TaskType AS tasktype",
			"lat",
            'status',
			"lng"
		];
	}


	/**
     * return edit page fields of the model.
     *
     * @return array
     */
	public static function editFields(){
		return [
			"ReportID AS reportid",
			"Description AS description",
			"TaskType AS tasktype",
			"lat",
            'status',
			"lng"
		];
	}

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'report_id', 'reportid');
    }
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
