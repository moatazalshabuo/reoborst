<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasktypeAddRequest;
use App\Http\Requests\TasktypeEditRequest;
use App\Models\Tasktype;
use Illuminate\Http\Request;
use Exception;
class TasktypeController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Tasktype::query();
		if($request->search){
			$search = trim($request->search);
			Tasktype::search($query, $search);
		}
		$orderby = $request->orderby ?? "tasktype.tasktypeid";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Tasktype::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Tasktype::query();
		$record = $query->findOrFail($rec_id, Tasktype::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(TasktypeAddRequest $request){
		$modeldata = $request->validated();
		
		//save Tasktype record
		$record = Tasktype::create($modeldata);
		$rec_id = $record->tasktypeid;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TasktypeEditRequest $request, $rec_id = null){
		$query = Tasktype::query();
		$record = $query->findOrFail($rec_id, Tasktype::editFields());
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
		$query = Tasktype::query();
		$query->whereIn("tasktypeid", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
