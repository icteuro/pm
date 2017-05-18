<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FileManager;
use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Validator;

class FileManagerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function upload() {

        if (Input::file('myfile')->isValid()) {
			$user = Auth::user();
            $destinationPath = 'uploads/_temp'; // upload path
            $extension = Input::file('myfile')->getClientOriginalExtension(); // getting image extension
            $fileName = $user->id.'-'.time(). '-' .uniqid() . '.' . $extension; // renameing image
            Input::file('myfile')->move($destinationPath, $fileName); // uploading file to given path
            echo $fileName;
        } else {
            echo 'Uploaded file is not valid';
        }
    }
    
    public function delete_temp_file(Request $request){
        $file_name = $request->input('file_name');
		//echo $file_name;
        unlink('uploads/_temp/'.$file_name);
    }
    
    public function get_issue_files(Request $request){
        $issue_id = $request->input('issue_id');
        if($issue_id){
            $data['user_id'] = Auth::user()->id;
            $data['files'] = DB::table('file_manager')
            ->join("users","users.id","=","file_manager.created_by")
            ->where('file_manager.issue_id', $issue_id)
            ->select("file_manager.*","users.name")
            ->get();
            return view('filemanager.index', $data);
        }
    }

}
