<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\ProjectModel;
use App\ProjectUserModel;

class ReportController extends Controller {

	public function __construct()
    {	
    	$this->middleware('auth');
        $this->middleware('userRole');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function project_list()
	{	
		//$projects = ProjectModel::orderBy('id','ASC')->get();
		/*$projects = DB::table('projects')
            ->join('project_user', 'project_user.project_id', '=', 'projects.id')
            ->join('tasks', 'tasks.project_id', '=', 'projects.id')
            ->groupBy('projects.id')
            ->select(DB::raw('count(project_user.id) as total_user, count(tasks.id) as total_tasks, projects.*'))
            ->get();*/

        $projects = DB::select("SELECT projects.*, 
        	(select sum(project_user.id) from project_user where project_user.project_id = projects.id) as total_time_spent,
        	(select count(project_user.id) from project_user where project_user.project_id = projects.id) as total_user,
        	(select count(tasks.id) from tasks where tasks.project_id = projects.id) as total_task,
        	(select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 1) as pending_task,
        	(select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 2) as ongoing_task,
        	(select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 3) as completed_task,
        	(select sum(tasks.estimated_hour) from tasks where tasks.project_id = projects.id) as total_estimated_task,
        	(select count(issues.id) from issues where issues.project_id = projects.id) as total_issues,
        	(select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 1) as pending_issues,
        	(select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 2) as ongoing_issues,
        	(select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 3) as completed_issues,
        	(select sum(issues.estimated_hours) from issues where issues.project_id = projects.id) as total_estimated_issues   
        	FROM `projects`");
		return view('reports.project_list', ['projects' => $projects]);
	}

    public function project_detail($id){
        
        $projects = DB::select("SELECT projects.*, 
            (select sum(tasks.estimated_hour) from tasks where tasks.project_id = projects.id) as total_estimated_time,
            (select count(project_user.id) from project_user where project_user.project_id = projects.id) as total_user,
            (select count(tasks.id) from tasks where tasks.project_id = projects.id) as total_task,
            (select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 1) as pending_task,
            (select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 2) as ongoing_task,
            (select count(tasks.id) from tasks where tasks.project_id = projects.id and tasks.status = 3) as completed_task,
            (select sum(tasks.estimated_hour) from tasks where tasks.project_id = projects.id) as total_estimated_task,
            (select count(issues.id) from issues where issues.project_id = projects.id) as total_issues,
            (select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 1) as pending_issues,
            (select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 2) as ongoing_issues,
            (select count(issues.id) from issues where issues.project_id = projects.id and issues.status = 3) as completed_issues,
            (select sum(issues.estimated_hours) from issues where issues.project_id = projects.id) as total_estimated_issues   
            FROM `projects` WHERE id=$id");
        

        return view('reports.project_detail', ['projects' => $projects] );
    }

}
