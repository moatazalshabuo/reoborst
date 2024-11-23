<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportsAddRequest;
use App\Http\Requests\ReportsEditRequest;
use App\Models\Reports;
use Illuminate\Http\Request;
use Exception;
class ReportsController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
    function index(Request $request, $fieldname = null, $fieldvalue = null)
    {
        $query = Reports::query()->with('attachments'); // جلب المرفقات مع البلاغات

        // البحث
        if ($request->search) {
            $search = trim($request->search);
            Reports::search($query, $search);
        }

        // الترتيب
        $orderby = $request->orderby ?? "reports.reportid";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);

        // الفلترة بناءً على اسم الحقل
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue);
        }

        // تنفيذ الاستعلام مع التصفح
        $records = $this->paginate($query, Reports::listFields());

        // الاستجابة
        return $this->respond($records);
    }


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
    function view($rec_id = null)
    {
        // استخدام with لجلب المرفقات مع البلاغ
        $query = Reports::query()->with('attachments');

        // البحث عن البلاغ المطلوب
        $record = $query->findOrFail($rec_id, Reports::viewFields());

        // الاستجابة
        return $this->respond($record);
    }



	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(ReportsAddRequest $request){
		$modeldata = $request->validated();

		//save Reports record
		$record = Reports::create($modeldata);
		$rec_id = $record->reportid;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ReportsEditRequest $request, $rec_id = null){
		$query = Reports::query();
		$record = $query->findOrFail($rec_id, Reports::editFields());
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
		$query = Reports::query();
		$query->whereIn("reportid", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
