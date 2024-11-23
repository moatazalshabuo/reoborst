<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentsAddRequest;
use App\Http\Requests\AttachmentsEditRequest;
use App\Models\Attachments;
use Illuminate\Http\Request;
use Exception;
class AttachmentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Attachments::query();
		if($request->search){
			$search = trim($request->search);
			Attachments::search($query, $search);
		}
		$query->join("reports", "attachments.report_id", "=", "reports.reportid");
		$orderby = $request->orderby ?? "attachments.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Attachments::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Attachments::query();
		$query->join("reports", "attachments.report_id", "=", "reports.reportid");
		$record = $query->findOrFail($rec_id, Attachments::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(AttachmentsAddRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("file_path", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file_path'], "file_path");
			$modeldata['file_path'] = $fileInfo['filepath'];
		}
		
		//save Attachments record
		$record = Attachments::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AttachmentsEditRequest $request, $rec_id = null){
		$query = Attachments::query();
		$record = $query->findOrFail($rec_id, Attachments::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
		
		if( array_key_exists("file_path", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['file_path'], "file_path");
			$modeldata['file_path'] = $fileInfo['filepath'];
		}
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
		$query = Attachments::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
