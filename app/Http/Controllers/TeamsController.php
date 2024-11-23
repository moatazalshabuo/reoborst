<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamsAddRequest;
use App\Http\Requests\TeamsEditRequest;
use App\Models\Teams;
use Illuminate\Http\Request;
use Exception;
class TeamsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Teams::query();
		if($request->search){
			$search = trim($request->search);
			Teams::search($query, $search);
		}
		$orderby = $request->orderby ?? "teams.teamid";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Teams::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Teams::query();
		$record = $query->findOrFail($rec_id, Teams::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(TeamsAddRequest $request){
		$modeldata = $request->validated();
		
		//save Teams record
		$record = Teams::create($modeldata);
		$rec_id = $record->teamid;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TeamsEditRequest $request, $rec_id = null){
		$query = Teams::query();
		$record = $query->findOrFail($rec_id, Teams::editFields());
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
		$query = Teams::query();
		$query->whereIn("teamid", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
