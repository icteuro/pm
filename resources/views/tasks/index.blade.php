@extends('app')
@section('content')
<!-- title start -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Task List - {{ $project_name }}</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
                <li><i class="icon_document_alt"></i>All</li>
            </ol>
        </div>
    </div>
    <!-- title end -->
    <!-- main Content start -->
    <div class="row">
        <div class="col-xs-6">
            <div class="filter taskselect-btn">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select Project
                    <span class="caret"></span></button>

                    <ul class="dropdown-menu">
                        <li><a href="{{ URL('tasks?project=all') }}">All</a></li>
                        @foreach($project_list as $project)
                            <li><a href="{{ URL('tasks?project='.$project->id) }}">{{ $project->project_name }}</a></li>
                        @endforeach
                    </ul>
                  </div>
                <br/>
                 <!-- <h2>Artdata</h2> -->
                 <p><?php //echo '<pre>'; print_r($project_list); echo '</pre>'; ?>Total: {{ $task_summary[0]->total_task }}, Upcoming: {{ $task_summary[0]->pending_task }}, Closed: {{ $task_summary[0]->completed_task }}, Ongoing: {{ $task_summary[0]->ongoing_task }}, Paused: {{ $task_summary[0]->paused_task }} </p>
                 
            </div>
        </div>
        <div class="col-xs-6">
            <div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridModalLabel">Add Task</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                      <div class="row">
                        <div class="col-md-12">
                            
                            {!! Form::open(array('url' => 'tasks', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="task_title">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Project</label>
                                        <select id="project_list1" class="selectpicker" data-live-search="true" title="Please Select" name="project_id">
                                            @if($project_list)
                                                @foreach($project_list as $project)
                                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="alert-danger">
                                            {{ $errors->first('project_id') }}
                                        </span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Task</label>
                                        <select id="task_list1" class="selectpicker" data-live-search="true" title="Please Select" name="task_id">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Assigned To</label>
                                        <select id="lunch" class="selectpicker" data-live-search="true" title="Please Select" name="assigned_to">
                                            @foreach($user_list as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Estimated Hours</label>
                                        <input type="text" class="form-control" name="estimated_hour">
                                    </div>

                                    <!--<div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="file" placeholder="Upload Files" name="task_file">
                                            <label class="input-group-btn">
                                                <span class="btn btn-default" style="padding: 9px 12px;">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>-->

                                       <div class="form-group">
                                            <label>Attachment</label>
                                            <div class="input-group">
                                                <div id="fileuploader_add" class="fileuploader">Upload</div>
                                                <div class='upload_status'></div>
                                            </div>
                                        </div>

                                </div>
                                <div class="col-md-6">
                                    
                                    

                                    <div class="form-group">
                                        <label>Estimated Start Date</label>
                                        <div class='input-group date' >
                                            <input type='text' class="form-control datetimepicker" name="estimated_start_date" id='datetimepicker1'/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Estimated End Date</label>
                                        <div class='input-group date' >
                                            <input type='text' class="form-control datetimepicker" name="estimated_end_date" id='datetimepicker2'/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" class="form-control" name="task_description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select name="priority" class="selectpicker" data-live-search="true" title="Please Select">
                                            <option value="3">High</option>
                                            <option value="2" selected="selected">Medium</option>
                                            <option value="1">Low</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="selectpicker" data-live-search="true" title="Change Status" name="status">
                                            <option value="1">Ongoing</option>
                                            <option value="2" selected="selected">Upcoming</option>
                                            <option value="3">Closed</option>
                                            <option value="4">Paused</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-actions pull-right">
                                            <button class="btn default" type="button" data-dismiss="modal">Cancel</button>
                                            <button class="btn green" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bd-example bd-example-padded-bottom">
              <button type="button" class="btn btn-primary pull-right popup_button" data-toggle="modal" data-target="#gridSystemModal" data-keyboard="false" data-backdrop="static">
                Add Task
              </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive table-responsive-margin">
            <?php //echo '<pre>'; print_r($project_list); echo '</pre>'; ?>
                @if (count($tasks) > 0)
                <table id="taskDataTables" class="table tree" data-stripe-classes="[]">
                    <thead>
                        <tr>
                            <th nowrap>Task No.</th>
                            <th nowrap>Task Name</th>
                            <th nowrap>Hrs (E)</th>
                            <th nowrap>Hrs (S)</th>
                            <th nowrap>Status</th>
                            <th nowrap>Assigned To</th>
                            <th nowrap>Start Date</th>
                            <th nowrap>End Date</th>
                            <th nowrap>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th nowrap style="width:5%"></th>
                            <th nowrap style="width:5%"></th>
                            <th nowrap style="width:5%"></th>
                            <th nowrap style="width:5%"></th>
                            <th nowrap style="width:5%"></th>
                            <th nowrap style="width:10%"></th>
                            <th nowrap style="width:10%"></th>
                            <th nowrap style="width:10%"></th>
                            <th nowrap style="width:10%"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php  //echo '<pre>'; print_r($tasks); echo '</pre>';  ?>
                         @foreach($tasks as $task)
                        <tr row_id="{{ $task->id }}" 
                        @if($task->status != 3)
                            @if ($task->priority == 3)
                            class = "priority-high"
                            @elseif ($task->priority == 2)
                            class = "priority-medium"
                            @elseif ($task->priority == 1)
                            class = "priority-low"
                            @endif 
                        @endif
                        >
                            <td>
                                <a href="#" class="issue_detail" data-id="{{ $task->id }}">{{ '#'.$task->project_id.'.'.$task->id }}</a>
                                <div class="hidden issue_detail_container"  data-id="{{ $task->id }}">
                                    {{ $task->description }}
                                </div> 
                            </td>
                            <td>{{ $task->title }} 
                             @if ($task->filecount)
                            <span class="glyphicon glyphicon-paperclip attachment_link" data-id="{{ $task->id }}" style="color:blue"></span>
                            @endif
                                <!--<button type="button" class="btn btn-primary btn-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Pending Clarification (2)">C
                                </button>-->
                            </td>
                            <td>{{ $task->estimated_hour }}</td>
                            <td>{{ $task->spent_hour }}</td>
                            <td>@if ($task->status == 1)
                                Ongoing
                            @elseif ($task->status == 2)
                                Upcoming
                            @elseif ($task->status == 3)
                                Complete
                            @elseif ($task->status == 4)
                                Paused
                            @endif
                            </td>
                            <td>{{ $task->name }}</td>
                            <td>
                                <p>{{ $task->estimated_start_date }}</p>
                            </td>
                            <td><p>{{ $task->estimated_end_date }}</p></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Detail</a></li>
                                        <li><a href="#"  
                                        data-id="{{ $task->id }}" 
                                        data-title="{{ $task->title }}" 
                                        data-project="{{ $task->project_id }}"
                                        data-task_user="{{ $task->user_id }}"
                                        data-estimated_hour="{{ $task->estimated_hour }}"
                                        data-spent_hour="{{ $task->spent_hour }}"
                                        data-estimated_start="{{ $task->estimated_start_date }}"
                                        data-estimated_end="{{ $task->estimated_end_date }}"
                                        data-description="{{ $task->description }}"
                                        data-priority="{{ $task->priority }}" 
                                        data-status="{{ $task->status }}" 
                                        class="edit_modal">Edit</a></li>
                                        <li><a href="{{ url('tasks/'.$task->id) }}" class="delete_confirm" data-id="{{ $task->id }}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>

                </table>
                @else
                    I don't have any records!
                @endif
            </div>
        </div>        
    </div>
    <!-- main Content end --> 

    <div id="taskEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridModalLabel2">Edit Task</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid bd-example-row">
                      <div class="row">
                        <div class="col-md-12">
                            <form id="editTask" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>

                                        <input type="hidden" class="task_id" name="id">
                                        <input type="text" class="form-control task_title" name="task_title">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Project</label>
                                        <select id="project" class="selectpicker project_id" data-live-search="true" title="Please Select" name="project_id">
                                            @if($project_list)
                                                @foreach($project_list as $project)
                                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Task</label>
                                        <select id="task_list_edit1" class="selectpicker" data-live-search="true" title="Please Select" name="parent_task_id">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Assigned To</label>
                                        <select id="assigned_to" class="selectpicker assigned_to" data-live-search="true" title="Please Select" name="assigned_to">
                                            <option >Select User</option>
                                            @foreach($user_list as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label>Attachment (will not replace previously uploaded files)</label>
                                        <div class="input-group">
                                            <div id="fileuploader_edit" class="fileuploader">Upload</div>
                                            <div class='upload_status'></div>
                                        </div>
                                    </div>

<div class="form-group">
                                        <label>Estimated Hours</label>
                                        <input type="text" class="form-control estimated_hour" name="estimated_hour" <?php if($user_detail->user_role != 1){ echo "readonly"; }?>>
                                    </div>
                                    
                                    

                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time Spent</label>
                                        <input type="text" class="form-control" id="spent_hour_edit" name="spent_hour_edit">
                                    </div>
                                    <div class="form-group">
                                        <label>Estimated Start Date</label>
                                        <div class='input-group date' >
                                            <input type='text' class="form-control estimated_start_date datetimepicker" name="estimated_start_date" id='datetimepicker_edit1'/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Estimated End Date</label>
                                        <div class='input-group date' >
                                            <input type='text' class="form-control estimated_end_date datetimepicker" name="estimated_end_date" id='datetimepicker_edit2'/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" class="form-control task_description" name="task_description" ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select name="priority" class="selectpicker" data-live-search="true" title="Please Select" id="task_priority_edit1">
                                            <option value="3">High</option>
                                            <option value="2">Medium</option>
                                            <option value="1">Low</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="selectpicker" data-live-search="true" title="Change Status" name="status" id="task_status_edit">
                                            <option value="1">Ongoing</option>
                                            <option value="2">Upcoming</option>
                                            <option value="3">Closed</option>
                                            <option value="4">Paused</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-actions pull-right">
                                            <button class="btn default" type="button" data-dismiss="modal">Cancel</button>
                                            <button class="btn green edit_task_submission" type="submit" >Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
    </div>

    <script type="text/javascript">
        

        $(document).on('click', '.edit_modal', function(e) {
        e.preventDefault();
        $('.task_id').val($(this).data("id"));
        $('.task_title').val($(this).data("title"));
        $('.estimated_hour').val($(this).data("estimated_hour"));
        $('#spent_hour_edit').val($(this).data("spent_hour"));
        $('.estimated_start_date').val($(this).data("estimated_start"));
        $('.estimated_end_date').val($(this).data("estimated_end"));
        $('.task_description').val($(this).data("description"));
        var project_id = $(this).data("project");
        $("#gridModalLabel2").append(" - " + project_id);
        $('#project option[value=' + project_id + ']').prop('selected', true);

        var task_priority = $(this).data("priority");
        $('#task_priority_edit1 option[value=' + task_priority + ']').prop('selected', true);

        var task_status = $(this).data("status");
        $('#task_status_edit option[value=' + task_status + ']').prop('selected', true);

        //$('.selectpicker').selectpicker('refresh');
        var user_id = $(this).data("task_user");
        
        if(user_id != ""){
            $('#assigned_to option[value=' + user_id + ']').prop('selected', true);
        }

        $('.selectpicker').selectpicker('refresh');
        $('#taskEditModal').modal('show');
    });

    

    $("#editTask").on('submit', function(e){
        e.preventDefault();
        /*var form = $("#editTask");
        var formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('file', $('input[type=file]')[0].files[0]);
        formData.append('id', $('.task_id').val());*/
        //alert($('.project_id').find(":selected").val());
        $.ajax({
            type: 'post',
            //dataType: "json",
            url: "../site/tasks/update2", 
            data: $(this).serialize(),
            /*{

                '_token' : $("input[name=_token]").val(),
                'id': $('.task_id').val(),
                'title': $(".task_title").val(),
                'project_id': $('.project_id').find(":selected").val(),
                'assigned_to': $('.assigned_to').find(":selected").val(),
                'estimated_hour': $(".estimated_hour").val(),
                'estimated_start_date': $(".estimated_start_date").val(),
                'estimated_end_date': $(".estimated_end_date").val(),
                'description': $('.task_description').val(),
                'task_file': $('#task_file2').val()
            }*/
            
            
            success: function(data) {
                $('#taskEditModal').modal('hide');
                //alert(JSON.stringify(data));
                location.reload(true);
            },
            error: function(data){
                //console.log(data);
            },
            complete: function(data){
                //console.log(data);
            }
        });
    })
   

    </script>
<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script> 

<script>
    $(document).ready(function()
    {   
        
        var myTable = $('#taskDataTables').DataTable({
            "bSort": false
          });

        yadcf.init(myTable, [
            {column_number : 0, filter_type: "text"},
            {column_number : 1, filter_type: "text"},
            {column_number : 4, filter_type: "text"},
            {column_number : 5, filter_type: "text"},
            ],
            {filters_position: 'footer'});
        

        $("#fileuploader").uploadFile({
        url:"../site/tasks/upload_file",
        fileName:"myfile",
        formData: { '_token' : $("input[name=_token]").val() },
        onSuccess:function(files,data,xhr,pd){
            $("#task_file2").val(data);
            
        },
        
        });


        uploaded_files = [];
        uploaded_files_name_orig = [];
        $("#fileuploader_add").uploadFile({
            url: "{{ url('file_manager/upload') }}",
            fileName: "myfile",
            statusBarWidth: '100%',
            dragdropWidth: '100%',
            multiple: true,
            maxFileSize: 10 * 1024 * 1024,
            showStatusAfterSuccess: false,
            sequential: true,
            sequentialCount: 1,
            formData: {},
            onSuccess: function (files, data, xhr, pd) {
                uploaded_files_name_orig.push(files);
                uploaded_files.push(data);
                // $(".ajax-file-upload-container").html(uploaded_files);
            },
            afterUploadAll: function (obj) {
                var file_html = "";
                var i;
                for (i = 0; i < uploaded_files.length; i++) {
                    file_html += "<div>" + uploaded_files_name_orig[i] + " <a href='#' class='delete_uploaded_files' data-file_name='" + uploaded_files[i] + "'>Delete</a><input type='hidden' name='uploaded_files[]' value='" + uploaded_files[i] + "' /></div>";
                }
                obj.next(".ajax-file-upload-container").html(file_html);
            }
        });

        $("#fileuploader_edit").uploadFile({
            url: "{{ url('file_manager/upload') }}",
            fileName: "myfile",
            statusBarWidth: '100%',
            dragdropWidth: '100%',
            multiple: true,
            maxFileSize: 10 * 1024 * 1024,
            showStatusAfterSuccess: false,
            sequential: true,
            sequentialCount: 1,
            formData: {},
            onSuccess: function (files, data, xhr, pd) {
                uploaded_files_name_orig.push(files);
                uploaded_files.push(data);
                // $(".ajax-file-upload-container").html(uploaded_files);
            },
            afterUploadAll: function (obj) {
                var file_html = "";
                var i;
                for (i = 0; i < uploaded_files.length; i++) {
                    file_html += "<div>" + uploaded_files_name_orig[i] + " <a href='#' class='delete_uploaded_files' data-file_name='" + uploaded_files[i] + "'>Delete</a><input type='hidden' name='uploaded_files[]' value='" + uploaded_files[i] + "' /></div>";
                }
                obj.next(".ajax-file-upload-container").html(file_html);
            }
        });

        $(document).on("click", ".delete_uploaded_files", function (e) {
            e.preventDefault();
            var file_name = $(this).data('file_name');
            $(this).parent("div").remove();
            $.ajax({
                url: "{{ url('file_manager/delete_temp_file') }}",
                type: "post",
                data: {file_name: file_name},
                success: function (result) {
                    uploaded_files_name_orig.splice(uploaded_files_name_orig.indexOf(file_name), 1);
                    uploaded_files.splice(uploaded_files.indexOf(file_name), 1);
                },
                error: function (a, b, c) {
                    alert(b);
                }
            });
        });
        $('.modal').on('hidden.bs.modal', function () {
            $(".ajax-file-upload-container").html("");
            uploaded_files = [];
            uploaded_files_name_orig = [];
        });

        $(".attachment_link").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('file_manager/get_task_files') }}",
                type: "post",
                data: {task_id: id},
                success: function (result) {
                    $("#AttachmentModal").find(".modal-title").html("Attachments");
                    $("#AttachmentModal").find(".modal-body").html(result);
                    $("#AttachmentModal").modal("show");
                },
                error: function (a, b, c) {
                    alert(b);
                }
            });
        });


    });

    $('#project_list1').change(function(){ 
        updateTaskList($('#project_list1').find('option:selected').val(), "#task_list1"); 
    });

    $('#project').change(function(){ 
        updateTaskList($('#project').find('option:selected').val(), "#task_list_edit1"); 
    });

    function updateTaskList(project_id, task_id){
        
        $.ajax({
            type: 'post',
            url: "../site/timesheets/taskByProjectID", 
            data: { 'project_id': project_id, '_token' : $("input[name=_token]").val(), },

            success: function(data) {
                var task_list = JSON.parse(data);
                
                $(task_id).html(task_list);
                $('.selectpicker').selectpicker('refresh');
                //alert(task_list);
                
            },
            error: function(data){
                
            },
            complete: function(data){
                
            }
        });
        
}

$(".issue_detail").on("click", function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var issue_detail = $(".issue_detail_container[data-id='"+id+"']").html();
    //var issue_title = $(this).html();
    //$("#AttachmentModal").find(".modal-title").html(issue_title);
    $("#AttachmentModal").find(".modal-title").html("Task Detail");
    $("#AttachmentModal").find(".modal-body").html(issue_detail);
    $("#AttachmentModal").modal("show");
});
</script>

<div id="AttachmentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Task Detail</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<?php if($errors->first('project_id')): ?>
    <script> 
        $(document).ready(function()
        {
           $("#gridSystemModal").modal("show");
        });
    </script>
<?php endif;?> 
   
@endsection