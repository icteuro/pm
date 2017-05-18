<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

//Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::get('/', ['middleware' => ['auth'], 'uses' => 'HomeController@index']);

Route::resource('projects', 'ProjectController');

Route::resource('tasks', 'TaskController');
Route::post('tasks/update2', 'TaskController@update2');
Route::post('tasks/upload_file', 'TaskController@upload_file');

Route::resource('issues', 'IssueController');
Route::post('issues/update2', 'IssueController@update2');

Route::get('users/user_list', ['uses' => 'Auth\AuthController@getUserList']);
Route::get('users/edit/{id}', ['uses' => 'Auth\AuthController@userEdit']);
Route::post('users/update', ['uses' => 'Auth\AuthController@update']);
Route::get('users/delete/{id}', ['uses' => 'Auth\AuthController@destroy']);

Route::resource('timesheets', 'TimesheetController');
Route::post('timesheets/taskByProjectID', 'TimesheetController@taskByProjectID');

Route::resource('file_manager', 'FileManagerController');
Route::post('file_manager/upload', 'FileManagerController@upload');
Route::post('file_manager/delete_temp_file', 'FileManagerController@delete_temp_file');
Route::post('file_manager/get_issue_files', 'FileManagerController@get_issue_files');
Route::post('file_manager/get_task_files', 'FileManagerController@get_task_files');
//Route::get('file_manager/delete_file/{id}', 'FileManagerController@delete_file');

Route::get('reports/project_list', 'ReportController@project_list');
Route::get('reports/project_detail/{id}', ['uses' => 'Auth\AuthController@destroy']);

Route::post('/sendmail', 'EmailController@sendmail');