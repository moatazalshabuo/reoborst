<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attachments extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'attachments';
	

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
	protected $fillable = ["file_path","report_id","updated_at","created_at"];
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"attachments.file_path AS file_path", 
			"attachments.report_id AS report_id", 
			"reports.tasktype AS reports_tasktype", 
			"attachments.updated_at AS updated_at", 
			"attachments.created_at AS created_at", 
			"reports.ReportID AS reports_reportid", 
			"attachments.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"attachments.file_path AS file_path", 
			"attachments.report_id AS report_id", 
			"reports.tasktype AS reports_tasktype", 
			"attachments.updated_at AS updated_at", 
			"attachments.created_at AS created_at", 
			"reports.ReportID AS reports_reportid", 
			"attachments.id AS id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"attachments.id AS id", 
			"attachments.file_path AS file_path", 
			"attachments.report_id AS report_id", 
			"attachments.updated_at AS updated_at", 
			"attachments.created_at AS created_at", 
			"reports.ReportID AS reports_reportid", 
			"reports.Description AS reports_description", 
			"reports.ReportDate AS reports_reportdate", 
			"reports.TaskType AS reports_tasktype", 
			"reports.lat AS reports_lat", 
			"reports.lng AS reports_lng" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"attachments.id AS id", 
			"attachments.file_path AS file_path", 
			"attachments.report_id AS report_id", 
			"attachments.updated_at AS updated_at", 
			"attachments.created_at AS created_at", 
			"reports.ReportID AS reports_reportid", 
			"reports.Description AS reports_description", 
			"reports.ReportDate AS reports_reportdate", 
			"reports.TaskType AS reports_tasktype", 
			"reports.lat AS reports_lat", 
			"reports.lng AS reports_lng" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"file_path", 
			"report_id", 
			"updated_at", 
			"created_at", 
			"id" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
