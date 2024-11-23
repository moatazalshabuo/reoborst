<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessServiceAddRequest;
use App\Http\Requests\ProcessServiceEditRequest;
use App\Models\ProcessService;
use App\Models\ServiceRequests;
use Illuminate\Http\Request;
use Exception;
class ProcessServiceController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $fieldname = null, $fieldvalue = null)
    {
        // بدء الاستعلام مع ضم الجداول المرتبطة
        $query = ProcessService::query()
            ->join('service_requests', 'process_service.service_request_id', '=', 'service_requests.id') // ربط مع جدول طلبات الخدمة
            ->join('service_types', 'service_requests.service_id', '=', 'service_types.id') // ربط مع جدول أنواع الخدمات
            ->join('teams', 'process_service.team_id', '=', 'teams.teamid') // ربط مع جدول الفرق
            ->select([
                'process_service.id',
                'process_service.status',
                'process_service.details',
                'process_service.assigned_date',
                'service_requests.id as service_request_id',
                'service_types.name as service_type_name', // اسم نوع الخدمة
                'teams.teamname as team_name'
            ]); // اختيار الحقول المطلوبة فقط

        // تطبيق البحث إذا كان موجودًا
        if ($request->search) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('service_types.name', 'LIKE', "%$search%") // البحث في اسم نوع الخدمة
                ->orWhere('teams.teamname', 'LIKE', "%$search%")
                    ->orWhere('process_service.details', 'LIKE', "%$search%");
            });
        }

        // تطبيق الترتيب
        $orderby = $request->orderby ?? "process_service.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);

        // فلترة حسب حقل معين إذا كان موجودًا
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue);
        }

        // التصفح
        $limit = $request->limit ?? 10;
        $page = $request->page ?? 1;
        $records = $query->paginate($limit, ['*'], 'page', $page);

        // إرسال الاستجابة
        return $this->respond([
            'records' => $records->items(),
            'totalRecords' => $records->total(),
            'recordCount' => $records->count(),
            'totalPages' => $records->lastPage(),
            'currentPage' => $records->currentPage(),
        ]);
    }





    /**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ProcessService::query();
		$record = $query->findOrFail($rec_id, ProcessService::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(ProcessServiceAddRequest $request){
		$modeldata = $request->validated();

		//save ProcessService record
		$record = ProcessService::create($modeldata);
        $request = ServiceRequests::find($record->service_request_id);
        $request->status = 'in_progress';
        $request->save();
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProcessServiceEditRequest $request, $rec_id = null){
		$query = ProcessService::query();
		$record = $query->findOrFail($rec_id, ProcessService::editFields());
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
		$query = ProcessService::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
