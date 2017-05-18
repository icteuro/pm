<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Issue;
use App\IssueFile;
use App\FileManager;
use Illuminate\Http\Request;
use Auth;
use DB;
use Input;

class IssueController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data['user_list'] = DB::table('users')->get();
        $user = Auth::user();
        
        $project_id = Input::get('project');
        
        if ($user->user_role == 1) {
            
            $data['project_list'] = DB::table('projects')->get();
            $query = DB::table('issues');

            $query->leftJoin('projects', 'projects.id', '=', 'issues.project_id');
            if($project_id && $project_id != "all"){
                $query->where("issues.project_id", "=", $project_id);
            }
            $query->select('issues.*', 'projects.project_name', DB::raw('(SELECT COUNT(*) FROM file_manager WHERE file_manager.issue_id = issues.id AND file_manager.type = 3) AS filecount'));
            $data['issues'] = $query->get();
        } else {
            $data['project_list'] = DB::table('projects')
                    ->join('project_user', 'project_user.project_id', '=', 'projects.id')
                    ->where('project_user.user_id', $user->id)
                    ->select('projects.*')
                    ->get();

            $data['issues'] = DB::table('issues')
                    ->join('project_user', function($join) {
                        $join->on('project_user.project_id', '=', 'issues.project_id');
                        $join->on('project_user.user_id', '=', $user->id);
                    })
                    ->leftJoin('file_manager', function($join) {
                        $join->on('file_manager.issue_id', '=', 'issues.id');
                        $join->on('file_manager.type', '=', '3');
                    })
                    ->leftJoin('projects', 'projects.id', '=', 'issues.project_id')
                    ->select('issues.*', 'file_manager.filename', 'projects.project_name')
                    ->get();
        }

        //echo "<pre>";print_r($data['issues']); die;
        return view('issues.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $issues = new Issue();
        $user = Auth::user();
//        if ($request->file('issue_file')) {
//            $fileName = $request->file('issue_file')->getClientOriginalName() . '_' . time() . '.' . $request->file('issue_file')->getClientOriginalExtension();
//            $request->file('issue_file')->move(base_path() . '/public/project_files/', $fileName);
//            //$issues->filename = $fileName;
//        }

        $issues->title = $request['title'];
        $issues->project_id = $request['project_id'];

        $issues->parent_task_id = $request['parent_task_id'];
        $issues->assigned_to = $request['assigned_to'];
        $issues->priority = $request['priority'];
        $issues->status = $request['status'];
        $issues->description = $request['description'];
        $issues->estimated_hours = $request['estimated_hours'];
        $issues->estimated_start_date = $request['estimated_start_date'];
        $issues->estimated_end_date = $request['estimated_end_date'];

        $issues->save();
        $id = $issues->id;


        //$id = ProjectModel::create($request->all())->id;
        $uploaded_files = $request['uploaded_files'];

        if ($uploaded_files) {

            foreach ($uploaded_files as $fileName) {
                $fileManager = new FileManager();
                $fileManager->filename = $fileName;
                $fileManager->type = 3;
                $fileManager->project_id = $request['project_id'];
                $fileManager->task_id = $request['parent_task_id'];
                $fileManager->issue_id = $id;
                $fileManager->created_by = $user->id;
                $fileManager->save();
                copy("uploads/_temp/$fileName", "uploads/filemanager/$fileName");
                unlink("uploads/_temp/$fileName");
            }
        }

        //echo '<pre>'; print_r($request['user_name']);echo '</pre>';
        return redirect('issues');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $issue = Issue::where("id", $id)->firstOrFail();
        $issue->where("id", $id)->delete();

        return 1;
    }

    public function update2(Request $request) {
        $user = Auth::user();
        $issues = Issue::find($request->id);


        $issues->title = $request['title'];
        $issues->project_id = $request['project_id'];

        $issues->parent_task_id = $request['parent_task_id'];
        $issues->assigned_to = $request['assigned_to'];
        $issues->priority = $request['priority'];
        $issues->status = $request['status'];
        $issues->description = $request['description'];
        $issues->estimated_hours = $request['estimated_hours'];
        $issues->estimated_start_date = $request['estimated_start_date'];
        $issues->estimated_end_date = $request['estimated_end_date'];
        $issues->save();

        $uploaded_files = $request['uploaded_files'];

        if ($uploaded_files) {

            foreach ($uploaded_files as $fileName) {
                $fileManager = new FileManager();
                $fileManager->filename = $fileName;
                $fileManager->type = 3;
                $fileManager->project_id = $request['project_id'];
                $fileManager->task_id = $request['parent_task_id'];
                $fileManager->issue_id = $request->id;
                $fileManager->created_by = $user->id;
                $fileManager->save();
                copy("uploads/_temp/$fileName", "uploads/filemanager/$fileName");
                unlink("uploads/_temp/$fileName");
            }
        }

        return response()->json($issues);
    }

}
