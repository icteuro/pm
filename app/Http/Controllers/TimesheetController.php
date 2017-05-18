<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Task;
use App\Timesheet;

use Illuminate\Http\Request;

class TimesheetController extends Controller {

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
		
		$data['user_list'] = DB::table('users')->get();
		$user = Auth::user();
		
        if($user->user_role == 1){
        	$data['project_list'] = DB::table('projects')->get();
        	$data['timesheet_list'] = DB::table('timesheets')->get();
            /*$data['tasks'] = DB::table('tasks')
            //->join('task_files', 'task_files.task_id', '=', 'tasks.id', 'left')
            ->join('task_users','task_users.task_id', '=', 'tasks.id', 'left')
            ->select('tasks.*', 'task_users.user_id')
            ->get();*/
        }
        else{
			$data['project_list'] = DB::table('projects')
        								->join('project_user', 'project_user.project_id', '=', 'projects.id')
        								->where('project_user.user_id', $user->id)
        								->select('projects.*')
        								->get();

            $data['timesheet_list'] = DB::table('timesheets')
            ->where('timesheets.user_id', '=', $user->id)
            ->get();
        }

        return view('timesheets.index', $data);
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
	public function store(Request $request)
	{	

		$timesheet = new Timesheet();
		$user = Auth::user();
        /*if ($request->file('task_file'))
        {
            $fileName = $request->file('task_file')->getClientOriginalName() . '.' . $request->file('task_file')->getClientOriginalExtension();
            $request->file('task_file')->move(base_path() . '/public/project_files/', $fileName);
            
        }*/

        $timesheet->title = $request['title'];
        $timesheet->description = $request['description'];
        $timesheet->user_id = $user->id;
        $timesheet->project_id = $request['project_id'];
        $timesheet->task_id = $request['task_id'];
        $timesheet->start_time = $request['start_time'];
        $timesheet->end_time = $request['end_time'];
        
        $timesheet->save();
        
        //$id = $task->id;

        //$id = ProjectModel::create($request->all())->id;
        
        /*if($request['assigned_to']){           
                $taskUser = new TaskUser();
                $taskUser->task_id = $id;
                $taskUser->user_id = $request['assigned_to'];
                $taskUser->save();            
        }

        if($request->file('task_file')){           
                $taskFile = new TaskFile();
                $taskFile->filename = $fileName;
                $taskFile->task_id = $id;
                $taskFile->save();            
        }*/
        
        //echo '<pre>'; print_r($request['user_name']);echo '</pre>';
        return redirect('timesheets');
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$timesheet = Timesheet::find($request->id);

        $timesheet->title = $request['title'];
        $timesheet->project_id = $request['project_id'];
        $timesheet->task_id = $request['task_id'];
        $timesheet->description = $request['description'];
        $timesheet->start_time = $request['start_time'];
        $timesheet->end_time = $request['end_time'];
        
        $timesheet->save();

        return 1;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$timesheet = Timesheet::where("id", $id)->firstOrFail();
        $timesheet->where("id", $id)->delete();

        return 1;
	}

	public function taskByProjectID(Request $request){
		$tasks = Task::where('project_id', $request->project_id)->select('id','title')->get();

		$task_option = "<option value=''>" . '' . "</option>";
        if ($tasks) {
            foreach ($tasks as $task) {
                $task_option .="<option value='" . $task->id . "'>" . $task->title . "</option>";
            }   
        }

		return json_encode($task_option);
	}

}
