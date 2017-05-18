@extends('app')
@section('content')
<!-- title start -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="">Issue List</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
            <li><i class="icon_document_alt"></i>Issue List</li>
        </ol>
    </div>
</div>
<!-- title end -->
<!-- main Content start -->
<div class="row">
    <div class="col-xs-6">
        <div class="filter">
            <div class="form-group">
                <label>Filter by Project</label>
                <select name="project_id" id="filter_by_project" class="selectpicker" data-live-search="true" title="Please Select">
                    <option value="all">All Projects</option>
                    @if($project_list)
                    @foreach($project_list as $project)
                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <p>Total:4 Open: 3 Closed:1 Ongoing:2</p>
        </div>
    </div>
    <div class="col-xs-6">
        <div id="addIssueModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Issue</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::open(array('url' => 'issues', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'issue_add_form')) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issue Title</label>
                                            <input name="title" type="text" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Project</label>
                                            <select name="project_id" class="selectpicker" data-live-search="true" title="Please Select">
                                                @if($project_list)
                                                @foreach($project_list as $project)
                                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Related Task</label>
                                            <select name="parent_task_id" class="selectpicker" data-live-search="true" title="Please Select">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Assigned To</label>
                                            <select name="assigned_to" class="selectpicker" data-live-search="true" title="Please Select">
                                                @foreach($user_list as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <select name="status" class="selectpicker status" data-live-search="true" title="Change Status">
                                                <option value="1" selected="selected">Pending</option>
                                                <option value="2">Ongoing</option>
                                                <option value="3">Closed</option>
                                                <option value="4">Paused</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Hours</label>
                                            <input type="text" class="form-control" name="estimated_hours">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="6" name="description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            <div class="input-group">
                                                <div id="fileuploader_add" class="fileuploader">Upload</div>
                                                <div class='upload_status'></div>
                                                <!--
                                                <input class="form-control" type="text" placeholder="Upload Files" disabled>
                                                <label class="input-group-btn">
                                                    <span class="btn btn-default" style="padding: 9px 12px;">
                                                        <i class="fa fa-upload" aria-hidden="true"></i><input name="issue_file" type="file" style="display: none;" multiple>
                                                    </span>
                                                </label>
                                                -->
                                            </div>
                                        </div>

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
                                        <div class="form-actions pull-right">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success" type="submit">Submit</button>
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
            <button type="button" class="btn btn-primary pull-right popup_button" data-toggle="modal" data-target="#addIssueModal" data-keyboard="false" data-backdrop="static">
                + Add Issue
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive table-responsive-margin">
            @if (count($issues) > 0)
            <table id="dataTables-example1" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Issue Name</th>
                        <th>Project</th>
                        <th>Hrs (E)</th>
                        <th>Hrs (S)</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($issues as $issue)
                    <tr row_id="{{$issue->id}}" 
                        @if($issue->status != 3)
                        @if ($issue->priority === 3)
                        class = "priority-high"
                        @elseif ($issue->priority === 2)
                        class = "priority-medium"
                        @elseif ($issue->priority === 1)
                        class = "priority-low"
                        @endif 
                        @endif
                        >
                        <td>
                            # {{ str_pad($issue->id, 8, "0", STR_PAD_LEFT) }}
                            @if ($issue->filecount)
                            <span class="glyphicon glyphicon-paperclip attachment_link" data-id="{{ $issue->id }}" style="color:blue"></span>
                            @endif
                            <br />
                            <a href="#" class="issue_detail" data-id="{{ $issue->id }}">
                                {{ $issue->title }}
                            </a>

                            <div class="hidden issue_detail_container"  data-id="{{ $issue->id }}">
                                {{ $issue->description }}
                            </div> 
                        </td>
                        <td>{{ $issue->project_id }} # {{ $issue->project_name }}</td>
                        <td>{{ $issue->estimated_hours }}</td>
                        <td></td>
                        <td>
                            @if($issue->status == 1)
                            <span class='label label-warning'>Pending</span>
                            @elseif ($issue->status === 2)
                            <span class='label label-info'>Ongoing</span>
                            @elseif ($issue->status === 3)
                            <span class='label label-success'>Closed</span>
                            @elseif ($issue->status === 4)
                            <span class='label label-danger'>Paused</span>
                            @endif
                        </td>
                        <td>{{ date("d-m-Y",strtotime($issue->created_at)) }}</td>
                        <td>E: {{ $issue->estimated_start_date }} <br> R: </td>
                        <td>E: {{ $issue->estimated_end_date }} <br> R: </td>
<!--                        <td>
                            @if ($issue->priority === 3)
                            <span class='label label-danger'>High</span>
                            @elseif ($issue->priority === 2)
                            <span class='label label-warning'>Medium</span>
                            @elseif ($issue->priority === 1)
                            <span class='label label-default'>Low</span>
                            @endif
                        </td>-->
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"  
                                           data-id="{{ $issue->id }}" 
                                           data-title="{{ $issue->title }}" 
                                           data-project="{{ $issue->project_id }}"
                                           data-parent_task_id="{{ $issue->parent_task_id }}"
                                           data-assigned_to="{{ $issue->assigned_to }}"
                                           data-estimated_hours="{{ $issue->estimated_hours }}"
                                           data-estimated_start="{{ $issue->estimated_start_date }}"
                                           data-estimated_end="{{ $issue->estimated_end_date }}"
                                           data-description="{{ $issue->description }}"
                                           data-status="{{ $issue->status }}" 
                                           data-priority="{{ $issue->priority }}"
                                           class="edit_modal">Edit</a></li>
                                    <li><a href="#">Timesheet +</a></li>
                                    <li><a href="#">Discussion +</a></li>
                                    <li><a href="#">Status</a></li>
                                    <li><a href="{{ url('issues/'.$issue->id) }}" class="delete_confirm" data-id="{{ $issue->id }}">Delete</a></li>
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


<div id="issueEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Issue</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(array('url' => 'issues/update2', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'issueEditForm')) !!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Issue Title</label>
                                    <input name="title" type="text" class="form-control issue_title" />
                                </div>

                                <div class="form-group">
                                    <label>Project</label>
                                    <select name="project_id" class="selectpicker project_id" data-live-search="true" title="Please Select">
                                        @if($project_list)
                                        @foreach($project_list as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Related Task</label>
                                    <select name="parent_task_id" class="selectpicker parent_task_id" data-live-search="true" title="Please Select">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Assigned To</label>
                                    <select name="assigned_to" class="selectpicker assigned_to" data-live-search="true" title="Please Select">
                                        @foreach($user_list as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select name="priority" class="selectpicker priority" data-live-search="true" title="Please Select">
                                        <option value="3">High</option>
                                        <option value="2" selected="selected">Medium</option>
                                        <option value="1">Low</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="selectpicker status" data-live-search="true" title="Change Status">
                                        <option value="1">Pending</option>
                                        <option value="2">Ongoing</option>
                                        <option value="3">Closed</option>
                                        <option value="4">Paused</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Estimated Hours</label>
                                    <input type="text" class="form-control estimated_hours" name="estimated_hours">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="8" name="description" class="form-control issue_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Attachment (will not replace previously uploaded files)</label>
                                    <div class="input-group">
                                        <div id="fileuploader_edit" class="fileuploader">Upload</div>
                                        <div class='upload_status'></div>
                                        <!--
                                        <input class="form-control" type="text" placeholder="Upload Files" disabled>
                                        <label class="input-group-btn">
                                            <span class="btn btn-default" style="padding: 9px 12px;">
                                                <i class="fa fa-upload" aria-hidden="true"></i><input name="issue_file" type="file" style="display: none;" multiple>
                                            </span>
                                        </label>
                                        -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Estimated Start Date</label>
                                    <div class='input-group date' >
                                        <input type='text' class="form-control estimated_start_date datetimepicker" name="estimated_start_date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Estimated End Date</label>
                                    <div class='input-group date' >
                                        <input type='text' class="form-control estimated_end_date datetimepicker" name="estimated_end_date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-actions pull-right">
                                    <input name="id" type="hidden" class="issue_id" value="0" />
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" id="issue_edit_submit" type="submit">Submit</button>
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

<div id="AttachmentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Response</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    issueEditModal = $("#issueEditModal");
    $(document).on('click', '.edit_modal', function (e) {
        e.preventDefault();
        issueEditModal.find('.issue_id').val($(this).data("id"));
        issueEditModal.find('.issue_title').val($(this).data("title"));
        issueEditModal.find('.estimated_hours').val($(this).data("estimated_hours"));
        issueEditModal.find('.estimated_start_date').val($(this).data("estimated_start"));
        issueEditModal.find('.estimated_end_date').val($(this).data("estimated_end"));
        issueEditModal.find('.issue_description').val($(this).data("description"));
        var project_id = $(this).data("project");

        issueEditModal.find('.project_id option[value=' + project_id + ']').prop('selected', true);


        var parent_task_id = $(this).data("parent_task_id");

        updateTaskList(issueEditModal.find('select[name = "project_id"]'), parent_task_id);


        var priority = $(this).data("priority");
        issueEditModal.find('.priority option[value=' + priority + ']').prop('selected', true);

        var status = $(this).data("status");
        issueEditModal.find('.status option[value=' + status + ']').prop('selected', true);
        //$('.selectpicker').selectpicker('refresh');
        var user_id = $(this).data("assigned_to");

        if (user_id != "") {
            issueEditModal.find('.assigned_to option[value=' + user_id + ']').prop('selected', true);
        }

        $('.selectpicker').selectpicker('refresh');
        $('#issueEditModal').modal('show');
    });



    $("#issueEditForm").on('submit', function (e) {
        e.preventDefault();

        /*var form = $("#editTask");
         var formData = new FormData();
         formData.append('_token', $("input[name=_token]").val());
         formData.append('file', $('input[type=file]')[0].files[0]);
         formData.append('id', $('.task_id').val());*/
        //alert($('.project_id').find(":selected").val());
        //alert($(this).serialize());
        $.ajax({
            type: 'post',
            //dataType: "json",
            url: "issues/update2",
            data: $(this).serialize(),
            success: function (data) {
                $('#issueEditModal').modal('hide');
                //alert(JSON.stringify(data));
                location.reload(true);
            },
            error: function (a, b, c) {
                //console.log(b);
            },
            complete: function (data) {
                // console.log(data);
            }
        });
    })

    $("select[name='project_id']").on("change", function () {
        updateTaskList($(this));
    });

    function updateTaskList(project_elm, task_id) {
        var project_id = project_elm.val();

        var tasklist_elm = project_elm.parents(".modal").find("select[name='parent_task_id']");
        $.ajax({
            type: 'post',
            url: "../site/timesheets/taskByProjectID",
            data: {'project_id': project_id, '_token': $("input[name=_token]").val(), },
            success: function (data) {
                var task_list = JSON.parse(data);

                tasklist_elm.html(task_list);



                $('.selectpicker').selectpicker('refresh');

                if (task_id) {
                    tasklist_elm.find('option[value="' + task_id + '"]').prop('selected', true);
                    $('.selectpicker').selectpicker('refresh');
                }


            },
            error: function (data) {

            },
            complete: function (data) {

            }
        });

    }
    $(document).ready(function ()
    {
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
                url: "{{ url('file_manager/get_issue_files') }}",
                type: "post",
                data: {issue_id: id},
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

        $(".issue_detail").on("click", function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var issue_detail = $(".issue_detail_container[data-id='"+id+"']").html();
            var issue_title = $(this).html();
            $("#AttachmentModal").find(".modal-title").html(issue_title);
            $("#AttachmentModal").find(".modal-body").html(issue_detail);
            $("#AttachmentModal").modal("show");
        });
        
        $("#filter_by_project").on("change",function(e){
            
           var project_id = $(this).val();
           location.href = "{{ URL('issues?project=') }}" + project_id;
           
        });
    });
</script>


@endsection