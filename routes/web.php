<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

//Route::get('/home', 'HomeController@index')->name('home');

// ********************************Login*********************************//
Auth::routes(['register' => false]);
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::group([  'middleware' => 'AuthChecking'], function () {
// ********************************Dashboard*********************************//
Route::get('/dashboard','DashboardController@dashboard');

// ********************************Designation*********************************//
Route::get('/designation','DesignationController@designation');
Route::get('/add_designation','DesignationController@add_designation');
Route::post('/designation_save_update','DesignationController@designation_save_update');
Route::post('/list_designation','DesignationController@list_designation');
Route::post('/designation_edit','DesignationController@designation_edit');
Route::post('/designation_delete','DesignationController@designation_delete');

// ********************************Department*********************************//
Route::get('/department_details','DepartmentController@department_details');
Route::get('/add_department','DepartmentController@add_department');
Route::post('/department_save_update','DepartmentController@department_save_update');
Route::post('/list_department','DepartmentController@list_department');
Route::post('/department_edit','DepartmentController@department_edit');
Route::post('/department_delete','DepartmentController@department_delete');

// ********************************Employee*********************************//
Route::get('/employee_details','EmployeeController@employee_details');
Route::get('/add_employee','EmployeeController@add_employee');
Route::post('/get_all_designation','EmployeeController@get_all_designation');
Route::post('/get_all_department','EmployeeController@get_all_department');
Route::post('/personaldetails_save_update','EmployeeController@personaldetails_save_update');
Route::post('/get_personal_details','EmployeeController@get_personal_details');
Route::post('/contactdetails_save_update','EmployeeController@contactdetails_save_update');
Route::post('/get_contact_details','EmployeeController@get_contact_details');
Route::post('/workingdetails_save_update','EmployeeController@workingdetails_save_update');
Route::post('/list_employee','EmployeeController@list_employee');
Route::post('/employee_edit','EmployeeController@employee_edit');
Route::post('/get_working_details','EmployeeController@get_working_details');
Route::post('/employee_delete','EmployeeController@employee_delete');
Route::post('/view_employee_details','EmployeeController@view_employee_details');

// ********************************Supervisor Wise Worker*********************************//
Route::get('/supervisor_wise_worker_details','SupervisorWiseWorkerController@supervisor_wise_worker_details');
Route::get('/add_supervisor_wise_worker','SupervisorWiseWorkerController@add_supervisor_wise_worker');
Route::post('/get_all_supervisor','SupervisorWiseWorkerController@get_all_supervisor');
Route::post('/get_all_worker','SupervisorWiseWorkerController@get_all_worker');
Route::post('/get_worker_name','SupervisorWiseWorkerController@get_worker_name');
Route::post('/save_supervisorwiseworker','SupervisorWiseWorkerController@save_supervisorwiseworker');
Route::post('/list_supervisorwiseworker','SupervisorWiseWorkerController@list_supervisorwiseworker');
Route::post('/get_supervisor_wise_worker','SupervisorWiseWorkerController@get_supervisor_wise_worker');
Route::post('/supervisorwiseworker_delete','SupervisorWiseWorkerController@supervisorwiseworker_delete');

// ********************************User*********************************//
Route::get('/user_details','UserController@user_details');
Route::get('/add_user','UserController@add_user');
Route::post('/get_all_employee_name','UserController@get_all_employee_name');
Route::post('/user_save_update','UserController@user_save_update');
Route::post('/list_user','UserController@list_user');
Route::post('/active_deactive_user','UserController@active_deactive_user');
Route::post('/user_edit','UserController@user_edit');

// ********************************Standard Post Wise Security Allocation*********************************//

Route::get('/Standerd_post_wise_security_allocation','PostWiseSecurityAllocationController@Standerd_post_wise_security_allocation');
Route::post('/search_post_wise_security','PostWiseSecurityAllocationController@search_post_wise_security');
Route::post('/get_all_location','PostWiseSecurityAllocationController@get_all_location');
Route::post('/get_all_post','PostWiseSecurityAllocationController@get_all_post');
Route::post('/get_all_shift','PostWiseSecurityAllocationController@get_all_shift');





// ********************************Location*********************************//
Route::get('/location','LocationController@location');
Route::get('/add_location','LocationController@add_location');
Route::post('/location_save_update','LocationController@location_save_update');
Route::post('/list_of_location','LocationController@list_of_location');
Route::post('/location_edit','LocationController@location_edit');




});






















