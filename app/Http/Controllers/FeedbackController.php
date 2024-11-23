<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackAddRequest;
use App\Http\Requests\FeedbackEditRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Exception;
class FeedbackController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Feedback::query();
		if($request->search){
			$search = trim($request->search);
			Feedback::search($query, $search);
		}
		$query->join("reports", "feedback.reportid", "=", "reports.reportid");
		$query->join("users", "feedback.userid", "=", "users.userid");
		$orderby = $request->orderby ?? "feedback.feedbackid";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Feedback::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Feedback::query();
		$query->join("reports", "feedback.reportid", "=", "reports.reportid");
		$query->join("users", "feedback.userid", "=", "users.userid");
		$record = $query->findOrFail($rec_id, Feedback::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(FeedbackAddRequest $request){
		$modeldata = $request->validated();
		
		//save Feedback record
		$record = Feedback::create($modeldata);
		$rec_id = $record->feedbackid;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(FeedbackEditRequest $request, $rec_id = null){
		$query = Feedback::query();
		$record = $query->findOrFail($rec_id, Feedback::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Feedback::query();
		$query->whereIn("feedbackid", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
