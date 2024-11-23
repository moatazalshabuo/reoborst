<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Feedback extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'feedback';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'feedbackid';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["reportid","userid","rating","comments"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				users.fullname LIKE ?  OR 
				feedback.Comments LIKE ? 
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
			"reports.TaskType AS reports_tasktype", 
			"users.fullname AS users_fullname", 
			"feedback.Rating AS rating", 
			"feedback.Comments AS comments", 
			"reports.ReportID AS reports_reportid", 
			"users.userid AS users_userid", 
			"feedback.FeedbackID AS feedbackid" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"reports.TaskType AS reports_tasktype", 
			"users.fullname AS users_fullname", 
			"feedback.Rating AS rating", 
			"feedback.Comments AS comments", 
			"reports.ReportID AS reports_reportid", 
			"users.userid AS users_userid", 
			"feedback.FeedbackID AS feedbackid" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"feedback.FeedbackID AS feedbackid", 
			"feedback.ReportID AS reportid", 
			"feedback.UserID AS userid", 
			"feedback.Rating AS rating", 
			"feedback.Comments AS comments", 
			"reports.ReportID AS reports_reportid", 
			"reports.Description AS reports_description", 
			"reports.ReportDate AS reports_reportdate", 
			"reports.TaskType AS reports_tasktype", 
			"reports.lat AS reports_lat", 
			"reports.lng AS reports_lng", 
			"users.userid AS users_userid", 
			"users.fullname AS users_fullname", 
			"users.phonenumber AS users_phonenumber", 
			"users.UserType AS users_usertype", 
			"users.img AS users_img" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"feedback.FeedbackID AS feedbackid", 
			"feedback.ReportID AS reportid", 
			"feedback.UserID AS userid", 
			"feedback.Rating AS rating", 
			"feedback.Comments AS comments", 
			"reports.ReportID AS reports_reportid", 
			"reports.Description AS reports_description", 
			"reports.ReportDate AS reports_reportdate", 
			"reports.TaskType AS reports_tasktype", 
			"reports.lat AS reports_lat", 
			"reports.lng AS reports_lng", 
			"users.userid AS users_userid", 
			"users.fullname AS users_fullname", 
			"users.phonenumber AS users_phonenumber", 
			"users.UserType AS users_usertype", 
			"users.img AS users_img" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"FeedbackID AS feedbackid", 
			"ReportID AS reportid", 
			"UserID AS userid", 
			"Rating AS rating", 
			"Comments AS comments" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
