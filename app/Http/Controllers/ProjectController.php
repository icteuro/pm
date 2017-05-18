<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ProjectModel;
use App\ProjectUserModel;

use App\Http\Requests\ProjectRequest;
use Auth;
use DB;
Use User;

class ProjectController extends Controller
{   
    public function __construct()
    {
        $this->middleware('userRole', ['except' => ['index','show']],'auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //This method is used for displaying projects list
        $user = Auth::user();
        $upcoming_projects = 0; $closed_projects = 0;
        if($user->user_role == 1){
            $upcoming_projects = ProjectModel::where('status', '1')->orderBy('id','ASC')->get();
            $active_projects = ProjectModel::where('status', '2')->orderBy('id','ASC')->get();
            $closed_projects = ProjectModel::where('status', '3')->orderBy('id','ASC')->get();
        }
        else{
            $active_projects = DB::table('projects')
            ->join('project_user', 'project_user.project_id', '=', 'projects.id')
            ->where('projects.status', '=', '2')
            ->where('project_user.user_id', '=', $user->id)
            ->select('projects.*')
            ->get();
        }
        
        return view('projects.index', [
            'upcoming_projects' => $upcoming_projects, 
            'active_projects' => $active_projects, 
            'closed_projects' => $closed_projects, 
            'user' => $user
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //This is predefined accounts type according to accounting rules
        //passed to accounts title add page for populating dropdown list
        $data['user_list'] = DB::table('users')->get();
        return view('projects.project_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $user = Auth::user();

        $projects = new ProjectModel();

        if ($request->file('project_file'))
        {
            $fileName = $request->file('project_file')->getClientOriginalName() . '.' . $request->file('project_file')->getClientOriginalExtension();
            $request->file('project_file')->move(base_path() . '/public/project_files/', $fileName);
            $projects->filename = $fileName;
        }

        $projects->project_name=$request['project_name'];
        $projects->project_description=$request['project_description'];
        
        $projects->estimated_start_date=$request['estimated_start_date'];
        $projects->target_deadline=$request['target_deadline'];
        $projects->status=$request['status'];
        $projects->project_type=$request['project_type'];
        $projects->framework=$request['framework'];

        $projects->created_by = $user->id;
        $projects->save();
        $id = $projects->id;

        
        //$id = ProjectModel::create($request->all())->id;

        
    
        $total_user = 0;

        if($request['user_name']){
            foreach($request['user_name'] as $user_name){
                $projectUser = new ProjectUserModel();
                $projectUser->project_id = $id;
                $projectUser->user_id = $user_name;
                $projectUser->user_role = $request['user_role'][$total_user];
                $projectUser->save();
                $total_user++;
            }
        }
        
        //echo '<pre>'; print_r($request['user_name']);echo '</pre>';
        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$project_detail=ProjectModel::where('id',$id)->firstOrFail();
        
        $project_detail = DB::select("SELECT projects.*, 
            (select time(sum((end_time - start_time))) from timesheets where timesheets.project_id = $id) as total_time_spent,
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
            (select sum(issues.estimated_hours) from issues where issues.project_id = projects.id) as total_estimated_issues,
            (select sum(issues.estimated_hours) from issues where issues.project_id = projects.id) as total_estimated_issues   
            FROM `projects` where projects.id = $id");

        //$project_detail[0]->users = DB::select("select * from project_user where project_user.project_id = $id)");
        $project_detail[0]->users = DB::select("SELECT project_user.*, 
            (select time(sum((end_time - start_time))) from timesheets where timesheets.project_id = $id && project_user.user_id = timesheets.user_id) as total_time_spent,
            (select time(sum(estimated_hour)) from tasks join task_users on tasks.id = task_users.task_id where tasks.project_id = $id AND project_user.user_id = task_users.user_id) as total_estimated_time
            FROM `project_user` where project_user.project_id = $id");

        return view('projects.project_detail', ['project' => $project_detail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $data['project_detail'] = ProjectModel::where('id',$id)->firstOrFail();
        //$data['project_users'] = ProjectUserModel::where('project_id',$id)->get();
        $data['project_users'] = DB::table('project_user')
                                    ->join('users', 'project_user.user_id', '=', 'users.id')
                                    ->where('project_user.project_id', '=', $id)
                                    ->select('users.*', 'project_user.*' )
                                    ->get();
        $data['user_list'] = DB::table('users')->get();

        return view('projects.project_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $user = Auth::user();
        $project = ProjectModel::find($id);
        
        if ($request->file('project_file'))
        {
            $fileName = $request->file('project_file')->getClientOriginalName() . '.' . $request->file('project_file')->getClientOriginalExtension();
            $request->file('project_file')->move(base_path() . '/public/project_files/', $fileName);
            $project->filename = $fileName;
        }

        $project->project_name = $request['project_name'];
        $project->project_description = $request['project_description'];
        $project->created_by = $user->id;
        $project->estimated_start_date = $request['estimated_start_date'];
        $project->target_deadline=$request['target_deadline'];
        $project->status = $request['status'];
        $project->project_type = $request['project_type'];
        $project->framework = $request['framework'];

        $project->save();
        $id = $project->id;

        $total_deleted = ProjectUserModel::where('project_id', '=', $id)->delete();

        $total_user = 0;
        //echo '<pre>';print_r($request['user_name']);exit;
        if($request['user_name']){
            foreach($request['user_name'] as $user_name){
                $projectUser = new ProjectUserModel();
                $projectUser->project_id = $id;
                $projectUser->user_id = $user_name;
                $projectUser->user_role = $request['user_role'][$total_user];
                if($user_name !=""){
                    $projectUser->save();
                }
                
                $total_user++;
            }
        }
        return redirect('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = ProjectModel::where("id", $id)->firstOrFail();
        $project->where("id", $id)->delete();

        return 1;
    }
}
