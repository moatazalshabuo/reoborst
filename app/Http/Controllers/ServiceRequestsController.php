<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequestsAddRequest;
use App\Http\Requests\ServiceRequestsEditRequest;
use App\Models\ServiceRequests;
use App\Models\ServiceTypes;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class ServiceRequestsController extends Controller
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
        // بدء الاستعلام مع ضم جدول service_types
        $query = ServiceRequests::query()
            ->join('service_types', 'service_requests.service_id', '=', 'service_types.id')
            ->join('users', 'service_requests.user_id', '=', 'users.userid')// الربط مع جدول أنواع الخدمات
            ->select([
                'service_requests.id',
                'users.fullname as name',
                'users.phonenumber as phone',
                'service_requests.lat',
                'service_requests.lan',
                'service_requests.count',
                'service_requests.cost',
                'service_requests.status',
                'service_requests.created_at',
                'service_requests.updated_at',
                'service_types.name as service_type_name', // اسم نوع الخدمة
            ]);

        // تطبيق البحث إذا كان موجودًا
        if ($request->search) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('service_types.name', 'LIKE', "%$search%") // البحث في اسم نوع الخدمة
                ->orWhere('service_requests.status', 'LIKE', "%$search%") // البحث في حالة الطلب
                ->orWhere('service_requests.lat', 'LIKE', "%$search%") // البحث في الإحداثيات
                ->orWhere('service_requests.lan', 'LIKE', "%$search%");
            });
        }

        // تطبيق الترتيب
        $orderby = $request->orderby ?? "service_requests.id";
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


    function indexMobile(Request $request){
        $records = ServiceRequests::Select('service_types', 'service_requests.service_id', '=', 'service_types.id')->where('service_requests.user_id',Auth::id())->get();

		return $this->respond($records);
	}

    /**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ServiceRequests::query();
		$record = $query->findOrFail($rec_id, ServiceRequests::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(ServiceRequestsAddRequest $request){
		$modeldata = $request->validated();

		//save ServiceRequests record
		$record = ServiceRequests::create($modeldata);
        $service_request = ServiceTypes::find($record->service_id);
        $record->cost = ($record->count * $service_request->price);
        $record->status = 'pending';
        $record->user_id = Auth::id();
        $record->save();
		$rec_id = $record->id;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ServiceRequestsEditRequest $request, $rec_id = null){
		$query = ServiceRequests::query();
		$record = $query->findOrFail($rec_id, ServiceRequests::editFields());
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
		$query = ServiceRequests::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
