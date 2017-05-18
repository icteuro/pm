<?php namespace App\Http\Controllers;

use Auth;
use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$user = Auth::user();
		

		if($user->user_role == 1){
            $task_query = DB::table('tasks');
            $task_query->join('task_users','task_users.task_id', '=', 'tasks.id', 'left');
            $task_query->join('users','users.id', '=', 'task_users.user_id', 'left');
            
            $task_query->select('tasks.*', 'task_users.user_id', 'users.name');
            $task_query->orderBy('status','asc')
            			->orderBy('priority', 'desc')
            			->orderBy('estimated_start_date', 'asc');
			$task_query->limit(5);
            $data['tasks'] = $task_query->get();

            $issues_query = DB::table('issues');

            $issues_query->leftJoin('projects', 'projects.id', '=', 'issues.project_id');
            
            $issues_query->select('issues.*', 'projects.project_name', DB::raw('(SELECT COUNT(*) FROM file_manager WHERE file_manager.issue_id = issues.id AND file_manager.type = 3) AS filecount'));
            $issues_query->limit(5);
            $data['issues'] = $issues_query->get();
        }
        else{

			$task_query = DB::table('tasks');
            $task_query->join('task_users','task_users.task_id', '=', 'tasks.id');
            $task_query->where('task_users.user_id', '=', $user->id);
            
            $task_query->select('tasks.*', 'task_users.user_id');
            $task_query->orderBy('status','asc')
            			->orderBy('priority', 'desc')
            			->orderBy('estimated_start_date', 'asc');
			$task_query->limit(5);
            $data['tasks'] = $task_query->get();

            /*$data['issues'] = DB::table('issues')
                    
                    ->join('project_user','project_user.project_id', '=', 'issues.project_id')
                    ->where('project_user.user_id', '=', $user->id)
                    ->leftJoin('file_manager', function($join) {
                    	$join->on('file_manager.type', '=', '3');
                        $join->on('file_manager.issue_id', '=', 'issues.id');
                        
                    })
                    ->leftJoin('projects', 'projects.id', '=', 'issues.project_id')
                    ->select('issues.*', 'file_manager.filename', 'projects.project_name')
                    ->limit(5)
                    ->get();*/
		}

		return view('home', $data);
	}

}
