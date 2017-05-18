@extends('app')
@section('content')
<!-- title start -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="">Add Project</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
            <li><i class="icon_document_alt"></i>Add Project</li>
        </ol>
    </div>
</div>
<!-- title end -->
<!-- main Content start -->
<div class="row">
	{!! Form::open(array('url' => 'projects', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
    <form role="form">
        <div class="col-md-6"> 
            <div class="form-group">
                <input type="text" placeholder="Project Name" class="form-control" name="project_name"> 
                <span class="alert-danger">{{ $errors->first('project_name') }}</span>
            </div>
            <div class="form-group">
                <textarea rows="3" class="form-control" placeholder="Project Description" name="project_description"></textarea>
            </div>
            <div class="form-group">
                <div class='input-group date' >
                    <input type='text' class="form-control" name="estimated_start_date" id='datetimepicker1'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class='input-group date' >
                    <input type='text' class="form-control" name="target_deadline" id='datetimepicker2'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" type="file" placeholder="Upload Files" name="project_file">
                    <label class="input-group-btn">
                        <span class="btn btn-default" style="padding: 9px 12px;">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div> 
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Select Users (Also roles can be defined)</label>
                <div id="user_role1" class="content">
                    <div class="row group user_list1">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <select class="selectpicker" data-live-search="true" title="User" name="user_name[]">
                                    <option value="1">User Name 1</option>
                                    <option value="2">User Name 2</option>
                                    <option value="3">User Name 3</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="selectpicker" data-live-search="true" title="Role" name="user_role[]">
                                    <option value="1">Manager</option>
                                    <option value="2">Team Leader</option>
                                    <option value="3">Developer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                            <button type="button" id="btnAdd-1" class="btn btn-primary btn-add"><i class="fa fa-plus"></i></button>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Created By</label>
                <select class="selectpicker" data-live-search="true" title="Please Select" name="created_by">
                    <option value="1">User1</option>
                    <option value="2">User2</option>
                    <option value="3">User3</option>
                </select>
            </div>
            <div class="form-group">
                <label>Project Type</label>
                <select class="selectpicker" data-live-search="true" title="Please Select" name="project_type">
                    <option value="1">Blog</option>
                    <option value="2">Ecommerce</option>
                    <option value="3">Portfolio</option>
                </select>
            </div>
            <div class="form-group">
                <label>Framework</label>
                <select class="selectpicker" data-live-search="true" title="Please Select" name="framework">
                    <option value="1">Codeigniter</option>
                    <option value="2">Laravel</option>
                    <option value="3">Wordpress</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-actions pull-right">
                    <button class="btn default" type="button">Cancel</button>
                    {!! Form::submit('Submit',['class'=>'btn green']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
<!-- main Content start --> 
@endsection