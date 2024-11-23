<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components Data Contoller
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Controller
 */
class Components_dataController extends Controller{
	public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['users_fullname_exist']]);
    }
	/**
     * report_id_option_list Model Action
     * @return array
     */
	function report_id_option_list(Request $request){
		$sqltext = "SELECT  DISTINCT reportid AS value,tasktype AS label FROM reports";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * reportid_option_list Model Action
     * @return array
     */
	function reportid_option_list(Request $request){
		$sqltext = "SELECT ReportID as value, ReportID as label FROM reports";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * userid_option_list Model Action
     * @return array
     */
	function userid_option_list(Request $request){
		$sqltext = "SELECT userid as value, fullname as label FROM users";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * team_id_option_list Model Action
     * @return array
     */
	function team_id_option_list(Request $request){
		$sqltext = "SELECT TeamID as value, teamname as label FROM teams";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * service_id_option_list Model Action
     * @return array
     */
	function service_id_option_list(Request $request){
		$sqltext = "SELECT id as value, name as label FROM service_types";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * check if fullname value already exist in Users
	 * @param string $value
     * @return bool
     */
	function users_fullname_exist(Request $request, $value){
		$exist = DB::table('users')->where('fullname', $value)->value('fullname');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
     * tasktype_option_list Model Action
     * @return array
     */
	function tasktype_option_list(Request $request){
		$sqltext = "SELECT  DISTINCT tasktype AS value,tasktype AS label FROM reports
GROUP BY reports.TaskTypeSELECT  DISTINCT tasktype AS value,tasktype AS label FROM reports
GROUP BY reports.TaskType";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
     * description_option_list Model Action
     * @return array
     */
	function description_option_list(Request $request){
		$sqltext = "SELECT  DISTINCT description AS value,description AS label FROM reports";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	/**
	* barchart_appuse Model Action
	* @return array
	*/
	function barchart_appuse(Request $request){
		$chart_data  = [];
		$sqltext = "SELECT  reports.tasktype FROM reports GROUP BY reports.tasktype";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'tasktype');
		$datasets = [];
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
}
