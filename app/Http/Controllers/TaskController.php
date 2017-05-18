<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use App\TaskUser;
use App\TaskFile;
use App\FileManager;
use Auth;
use DB;
use Input;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//This method is for tasks listing
		$data['project_name'] = $project_id = Input::get('project');
		$data['user_list'] = DB::table('users')->get();
		$user = Auth::user();
		$data['user_detail'] = $user;
		
        if($user->user_role == 1){
        	$data['project_list'] = DB::table('projects')->get();
            //$data['tasks'] = Task::orderBy('id','ASC')->get();
            $task_query = DB::table('tasks');
            $task_query->join('task_users','task_users.task_id', '=', 'tasks.id', 'left');
            $task_query->join('users','users.id', '=', 'task_users.user_id', 'left');
            if($data['project_name'] != 'all'){
            	$task_query->where('tasks.project_id', '=', $data['project_name']);
            }
            $task_query->select('tasks.*', 'task_users.user_id', 'users.name', DB::raw('(SELECT COUNT(*) FROM file_manager WHERE file_manager.task_id = tasks.id AND file_manager.type = 2) AS filecount'));
            $task_query->orderBy('status','asc')
            			->orderBy('priority', 'desc')
            			->orderBy('estimated_start_date', 'asc');
            $data['tasks'] = $task_query->get();

            if($data['project_name'] == 'all'){
            	$data['task_summary'] = DB::select("SELECT 
	            (select count(tasks.id) from tasks) as total_task,
	            (select count(tasks.id) from tasks where tasks.status = 1) as ongoing_task,
	            (select count(tasks.id) from tasks where tasks.status = 2) as pending_task,
	            (select count(tasks.id) from tasks where tasks.status = 3) as completed_task,
	            (select count(tasks.id) from tasks where tasks.status = 4) as paused_task
	            ");
            }
            else{
            	$data['task_summary'] = DB::select("SELECT 
	            (select count(tasks.id) from tasks where project_id = $project_id) as total_task,
	            (select count(tasks.id) from tasks where status = 1 and project_id = $project_id) as ongoing_task,
	            (select count(tasks.id) from tasks where status = 2 and project_id = $project_id) as pending_task,
	            (select count(tasks.id) from tasks where status = 3 and project_id = $project_id) as completed_task,
	            (select count(tasks.id) from tasks where tasks.status = 4 and project_id = $project_id) as paused_task
	            ");
            }
            
        }
        else{
        	$data['project_list'] = DB::table('projects')
        								->join('project_user', 'project_user.project_id', '=', 'projects.id')
        								->where('project_user.user_id', $user->id)
        								->select('projects.*')
        								->get();
			
			$task_query = DB::table('tasks');
            $task_query->join('task_users','task_users.task_id', '=', 'tasks.id');
            $task_query->where('task_users.user_id', '=', $user->id);
            if($data['project_name'] != 'all'){
            	$task_query->where('tasks.project_id', '=', $data['project_name']);
            }
            $task_query->select('tasks.*', 'task_users.user_id', DB::raw('(SELECT COUNT(*) FROM file_manager WHERE file_manager.task_id = tasks.id AND file_manager.type = 2) AS filecount'));
            $data['tasks'] = $task_query->get();

            if($data['project_name'] == 'all'){
            	$data['task_summary'] = DB::select("SELECT 
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id) as total_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where tasks.status = 1) as ongoing_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where tasks.status = 2) as pending_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where tasks.status = 3) as completed_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where tasks.status = 4) as paused_task
	            ");
            }
            else{
            	$data['task_summary'] = DB::select("SELECT 
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where project_id = $project_id) as total_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where status = 1 and project_id = $project_id) as ongoing_task,
	            (select count(tasks.id) from tasks  join task_users on task_users.task_id = tasks.id where status = 2 and project_id = $project_id) as pending_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where status = 3 and project_id = $project_id) as completed_task,
	            (select count(tasks.id) from tasks join task_users on task_users.task_id = tasks.id where status = 4 and project_id = $project_id) as paused_task
	            ");
            }
        }

        return view('tasks.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TaskRequest $request)
	{
		//
        $task = new Task();
        $user = Auth::user();

        if ($request->file('task_file'))
        {
            $fileName = $request->file('task_file')->getClientOriginalName() . '.' . $request->file('task_file')->getClientOriginalExtension();
            $request->file('task_file')->move(base_path() . '/public/project_files/', $fileName);
            
        }

        $task->title = $request['task_title'];
        $task->description = $request['task_description'];
        $task->estimated_hour = $request['estimated_hour'];
        $task->project_id = $request['project_id'];
        $task->project_task_id = $request['parent_task_id'] ?: '';

        $task->estimated_start_date = $request['estimated_start_date'];
        $task->estimated_end_date = $request['estimated_end_date'];
        $task->priority = $request['priority'];
        $task->status = $request['status'];

        //$task->created_by = $request['created_by'];
        $task->save();
        $id = $task->id;

        //$id = ProjectModel::create($request->all())->id;
        
        if($request['assigned_to']){           
                $taskUser = new TaskUser();
                $taskUser->task_id = $id;
                $taskUser->user_id = $request['assigned_to'];
                $taskUser->save();            
        }

        $uploaded_files = $request['uploaded_files'];

        if ($uploaded_files) {

            foreach ($uploaded_files as $fileName) {
                $fileManager = new FileManager();
                $fileManager->filename = $fileName;
                $fileManager->type = 2;
                $fileManager->project_id = $request['project_id'];
                $fileManager->task_id = $id;
                $fileManager->created_by = $user->id;
                $fileManager->save();
                copy("uploads/_temp/$fileName", "uploads/filemanager/$fileName");
                unlink("uploads/_temp/$fileName");
            }
        }

       /* if($request->file('task_file')){           
                $taskFile = new TaskFile();
                $taskFile->filename = $fileName;
                $taskFile->task_id = $id;
                $taskFile->save();            
        } */
        
        //echo '<pre>'; print_r($request['user_name']);echo '</pre>';
        return redirect('tasks?project='.$request['project_id']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{	

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		//return 'test';exit;
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update2(TaskRequest $req)
	{
		$user = Auth::user();
		
		$task = Task::find ( $req->id );
        $task->title = $req->task_title;
        $task->project_id = $req->project_id;
        $task->description = $req->task_description;
        $task->task_file = $req->task_file;
        $task->estimated_hour = $req->estimated_hour;
        $task->spent_hour = $req->spent_hour_edit;
        $task->estimated_start_date = $req->estimated_start_date;
        $task->estimated_end_date = $req->estimated_end_date;
        $task->priority = $req->priority;
        $task->status = $req->status;
        $task->save ();

        if($req['assigned_to']){  

	        TaskUser::updateOrCreate(
			   ['task_id' => $req->id],
			   ['user_id' => $req['assigned_to']]
			); 

        }


        $uploaded_files = $req->uploaded_files;

        if ($uploaded_files) {

            foreach ($uploaded_files as $fileName) {
                $fileManager = new FileManager();
                $fileManager->filename = $fileName;
                $fileManager->type = 2;
                $fileManager->project_id = $req->project_id;
                $fileManager->task_id = $req->id;
                $fileManager->created_by = $user->id;
                $fileManager->save();
                copy("uploads/_temp/$fileName", "uploads/filemanager/$fileName");
                unlink("uploads/_temp/$fileName");
            }
        }

       return response ()->json($task);
        
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = Task::where("id", $id)->firstOrFail();
        $task->where("id", $id)->delete();

        return 1;
	}

	public function upload_file(Request $req){
		
		if ($req->hasFile('myfile'))
        {	
            //$fileName = $req->file('task_file')->getClientOriginalName() . '.' . $req->file('task_file')->getClientOriginalExtension();
            $fileName = $req->file('myfile')->getClientOriginalName();
            $req->file('myfile')->move(base_path() . '/public/project_files/', $fileName);
            return $fileName;
        }
		/*$destinationPath = base_path() . '/public/project_files/';
		Input::file('myfile')->move($destinationPath, $fileName);

		// Sample save in the database
		$image = new Image();
		$image->path = $destinationPath . $fileName;
		$image->name = 'Webpage logo';
		$image->save();*/
	}

}
