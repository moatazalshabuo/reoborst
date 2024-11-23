<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeammembersAddRequest;
use App\Http\Requests\TeammembersEditRequest;
use App\Models\Teammembers;
use Illuminate\Http\Request;
use Exception;
class TeammembersController extends Controller
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
        $query = Teammembers::query()
            ->join('users', 'teammembers.userid', '=', 'users.userid') // الربط مع جدول المستخدمين
            ->join('teams', 'teammembers.teamid', '=', 'teams.teamid') // الربط مع جدول الفرق
            ->select([
                'teammembers.memberid',
                'users.fullname as username',
                'teams.teamname',
                'teammembers.userid',
                'teammembers.teamid'
            ]); // اختيار الحقول المطلوبة فقط

        // تطبيق البحث إذا كان موجودًا
        if ($request->search) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('users.fullname', 'LIKE', "%$search%")
                    ->orWhere('teams.teamname', 'LIKE', "%$search%")
                    ->orWhere('teammembers.memberid', 'LIKE', "%$search%");
            });
        }

        // تطبيق الترتيب
        $orderby = $request->orderby ?? "teammembers.memberid";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);

        // فلترة حسب حقل معين إذا كان موجودًا
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue);
        }

        // تنفيذ الاستعلام مع التصفح
        $records = $this->paginate($query);

        // إرسال الاستجابة
        return $this->respond($records);
    }



    /**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Teammembers::query();
		$record = $query->findOrFail($rec_id, Teammembers::viewFields());
		return $this->respond($record);
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(TeammembersAddRequest $request){
		$modeldata = $request->validated();

		//save Teammembers record
		$record = Teammembers::create($modeldata);
		$rec_id = $record->memberid;
		return $this->respond($record);
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TeammembersEditRequest $request, $rec_id = null){
		$query = Teammembers::query();
		$record = $query->findOrFail($rec_id, Teammembers::editFields());
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
		$query = Teammembers::query();
		$query->whereIn("memberid", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
