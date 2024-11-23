<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// api routes that need auth

Route::middleware(['auth:api'])->group(function () {


/* routes for Attachments Controller  */
	Route::get('attachments/', 'AttachmentsController@index');
	Route::get('attachments/index', 'AttachmentsController@index');
	Route::get('attachments/index/{filter?}/{filtervalue?}', 'AttachmentsController@index');
	Route::get('attachments/view/{rec_id}', 'AttachmentsController@view');
	Route::post('attachments/add', 'AttachmentsController@add');
	Route::any('attachments/edit/{rec_id}', 'AttachmentsController@edit');
	Route::any('attachments/delete/{rec_id}', 'AttachmentsController@delete');

/* routes for Feedback Controller  */
	Route::get('feedback/', 'FeedbackController@index');
	Route::get('feedback/index', 'FeedbackController@index');
	Route::get('feedback/index/{filter?}/{filtervalue?}', 'FeedbackController@index');
	Route::get('feedback/view/{rec_id}', 'FeedbackController@view');
	Route::post('feedback/add', 'FeedbackController@add');
	Route::any('feedback/edit/{rec_id}', 'FeedbackController@edit');
	Route::any('feedback/delete/{rec_id}', 'FeedbackController@delete');

/* routes for ProcessReports Controller  */
	Route::get('processreports/', 'ProcessReportsController@index');
	Route::get('processreports/index', 'ProcessReportsController@index');
	Route::get('processreports/index/{filter?}/{filtervalue?}', 'ProcessReportsController@index');
	Route::get('processreports/view/{rec_id}', 'ProcessReportsController@view');
	Route::post('processreports/add', 'ProcessReportsController@add');
	Route::any('processreports/edit/{rec_id}', 'ProcessReportsController@edit');
	Route::any('processreports/delete/{rec_id}', 'ProcessReportsController@delete');

/* routes for ProcessService Controller  */
	Route::get('processservice/', 'ProcessServiceController@index');
	Route::get('processservice/index', 'ProcessServiceController@index');
	Route::get('processservice/index/{filter?}/{filtervalue?}', 'ProcessServiceController@index');
	Route::get('processservice/view/{rec_id}', 'ProcessServiceController@view');
	Route::post('processservice/add', 'ProcessServiceController@add');
	Route::any('processservice/edit/{rec_id}', 'ProcessServiceController@edit');
	Route::any('processservice/delete/{rec_id}', 'ProcessServiceController@delete');

/* routes for Reports Controller  */
	Route::get('reports/', 'ReportsController@index');
	Route::get('reports/index', 'ReportsController@index');
	Route::get('reports/index/{filter?}/{filtervalue?}', 'ReportsController@index');
	Route::get('reports/view/{rec_id}', 'ReportsController@view');
	Route::post('reports/add', 'ReportsController@add');
	Route::any('reports/edit/{rec_id}', 'ReportsController@edit');
	Route::any('reports/delete/{rec_id}', 'ReportsController@delete');

/* routes for ServiceRequests Controller  */
	Route::get('servicerequests/', 'ServiceRequestsController@index');
	Route::get('servicerequests/index', 'ServiceRequestsController@index');
	Route::get('servicerequests/index/{filter?}/{filtervalue?}', 'ServiceRequestsController@index');
	Route::get('servicerequests/index-mobile', 'ServiceRequestsController@indexMobile');
	Route::get('servicerequests/view/{rec_id}', 'ServiceRequestsController@view');
	Route::post('servicerequests/add', 'ServiceRequestsController@add');
	Route::any('servicerequests/edit/{rec_id}', 'ServiceRequestsController@edit');
	Route::any('servicerequests/delete/{rec_id}', 'ServiceRequestsController@delete');

/* routes for ServiceTypes Controller  */
	Route::get('servicetypes/', 'ServiceTypesController@index');
	Route::get('servicetypes/index', 'ServiceTypesController@index');
	Route::get('servicetypes/index/{filter?}/{filtervalue?}', 'ServiceTypesController@index');
	Route::get('servicetypes/view/{rec_id}', 'ServiceTypesController@view');
	Route::post('servicetypes/add', 'ServiceTypesController@add');
	Route::any('servicetypes/edit/{rec_id}', 'ServiceTypesController@edit');
	Route::any('servicetypes/delete/{rec_id}', 'ServiceTypesController@delete');

/* routes for Teammembers Controller  */
	Route::get('teammembers/', 'TeammembersController@index');
	Route::get('teammembers/index', 'TeammembersController@index');
	Route::get('teammembers/index/{filter?}/{filtervalue?}', 'TeammembersController@index');
	Route::get('teammembers/view/{rec_id}', 'TeammembersController@view');
	Route::post('teammembers/add', 'TeammembersController@add');
	Route::any('teammembers/edit/{rec_id}', 'TeammembersController@edit');
	Route::any('teammembers/delete/{rec_id}', 'TeammembersController@delete');

/* routes for Teams Controller  */
	Route::get('teams/', 'TeamsController@index');
	Route::get('teams/index', 'TeamsController@index');
	Route::get('teams/index/{filter?}/{filtervalue?}', 'TeamsController@index');
	Route::get('teams/view/{rec_id}', 'TeamsController@view');
	Route::post('teams/add', 'TeamsController@add');
	Route::any('teams/edit/{rec_id}', 'TeamsController@edit');
	Route::any('teams/delete/{rec_id}', 'TeamsController@delete');

/* routes for Users Controller  */
	Route::get('users/', 'UsersController@index');
	Route::get('users/index', 'UsersController@index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index');
	Route::get('users/view/{rec_id}', 'UsersController@view');
	Route::any('account/edit', 'AccountController@edit');
	Route::get('account', 'AccountController@index');
	Route::get('account/currentuserdata', 'AccountController@currentuserdata');
	Route::post('users/add', 'UsersController@add');
	Route::any('users/edit/{rec_id}', 'UsersController@edit');
	Route::any('users/delete/{rec_id}', 'UsersController@delete');

});
use App\Http\Controllers\stateController;
// Route للإحصائيات
Route::get('/statistics', [stateController::class, 'index']);
Route::get('home', 'HomeController@index');

Route::post('reports/add', 'ReportsController@add');

	Route::post('auth/register', 'AuthController@register');
	Route::post('auth/login', 'AuthController@login');
	Route::get('login', 'AuthController@login')->name('login');


	Route::get('components_data/report_id_option_list/{arg1?}', 'Components_dataController@report_id_option_list');
	Route::get('components_data/reportid_option_list/{arg1?}', 'Components_dataController@reportid_option_list');
	Route::get('components_data/userid_option_list/{arg1?}', 'Components_dataController@userid_option_list');
	Route::get('components_data/team_id_option_list/{arg1?}', 'Components_dataController@team_id_option_list');
	Route::get('components_data/service_id_option_list/{arg1?}', 'Components_dataController@service_id_option_list');
	Route::get('components_data/users_fullname_exist/{arg1?}', 'Components_dataController@users_fullname_exist');
	Route::get('components_data/tasktype_option_list/{arg1?}', 'Components_dataController@tasktype_option_list');
	Route::get('components_data/description_option_list/{arg1?}', 'Components_dataController@description_option_list');
	Route::get('components_data/barchart_appuse/{arg1?}', 'Components_dataController@barchart_appuse');


/* routes for FileUpload Controller  */
Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');
