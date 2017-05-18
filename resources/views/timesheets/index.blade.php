@extends('app')
@section('content')
<!-- title start -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Time Sheet</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
                <li><i class="icon_document_alt"></i>Time Sheet</li>
            </ol>
        </div>
    </div>
    <!-- title end -->
    <!-- main Content start -->
   <div class="row">
                    <div class="col-xs-6">
                        <div class="filter">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridModalLabel">Add Time Sheet</h4>
                              </div>
                              <div class="modal-body">
                                <div class="container-fluid bd-example-row">
                                  <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::open(array('url' => 'timesheets', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                                            <div class="col-md-6">
                                                <!-- <div class="form-group">
                                                    <label>Add Time Sheet</label>
                                                    <input type="text" class="form-control">
                                                </div> -->
                                                

                                                <div class="form-group">
                                                    <label>Project</label>
                                                    <select id="project_list1" class="selectpicker" data-live-search="true" title="Please Select" name="project_id">
                                                        @if($project_list)
                                                            @foreach($project_list as $project)
                                                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Task</label>
                                                    <select id="task_list1" class="selectpicker" data-live-search="true" title="Please Select" name="task_id">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' class="form-control datetimepicker" name="start_time"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <div class='input-group date' id='datetimepicker2'>
                                                        <input type='text' class="form-control datetimepicker" name="end_time"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="4" class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions pull-right">
                                                <button class="btn default" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn green" type="submit">Submit</button>
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
                            Add Time Sheet
                          </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-responsive-margin">
                            <?php //echo '<pre>'; print_r($timesheet_list); echo '</pre>'; ?>
                            @if (count($timesheet_list) > 0)
                            <table id="dataTables-example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        
                                        <th>Duration(Hrs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timesheet_list as $timesheet)
                                    <tr row_id="{{ $timesheet->id }}">
                                        <td>{{ $timesheet->title }}</td>
                                        <td>{{ Carbon\Carbon::parse($timesheet->start_time)->format('d-m-Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($timesheet->start_time)->format('H:i') }}</td>
                                        
                                        <td>{{ Carbon\Carbon::parse($timesheet->end_time)->diff(Carbon\Carbon::parse($timesheet->start_time))->format('%H:%i') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Detail</a></li>

                                                    <li><a href="#"  
                                                    data-id="{{ $timesheet->id }}" 
                                                    data-title="{{ $timesheet->title }}" 
                                                    data-description="{{ $timesheet->description }}"
                                                    data-project="{{ $timesheet->project_id }}"
                                                    data-task_user="{{ $timesheet->user_id }}"
                                                    data-task_id="{{ $timesheet->task_id }}"
                                                    data-issue_id="{{ $timesheet->issue_id }}"
                                                    data-start_time="{{ $timesheet->start_time }}"
                                                    data-end_time="{{ $timesheet->end_time }}"
                                                    class="edit_modal">Edit</a></li>
                                                    <li><a href="{{ url('timesheets/'.$timesheet->id) }}" class="delete_confirm" data-id="{{ $timesheet->id }}">Delete</a></li>
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

    <div id="timesheetEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridModalLabel">Edit Time Sheet</h4>
                              </div>
                              <div class="modal-body">
                                <div class="container-fluid bd-example-row">
                                  <div class="row">
                                    <div class="col-md-12">
                                            <form id="editTimesheet" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                

                                                <div class="form-group">
                                                    <label>Project</label>
                                                    <select id="project_list_edit1" class="selectpicker" data-live-search="true" title="Please Select" name="project_id">
                                                        @if($project_list)
                                                            @foreach($project_list as $project)
                                                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Task</label>
                                                    <select id="task_list_edit1" class="selectpicker task_list1" data-live-search="true" title="Please Select" name="task_id">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' class="form-control datetimepicker" name="start_time" id="start_time_edit"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <div class='input-group date' id="datetimepicker2">
                                                        <input type='text' class="form-control datetimepicker" name="end_time" id="end_time_edit"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="hidden" id="timesheet_id" name="id">
                                                    <input type="text" class="form-control" name="title" id="timesheet_title_edit">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="4" class="form-control" name="description" id="description_edit"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions pull-right">
                                                <button class="btn default" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn green" type="submit">Submit</button>
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
        $(document).on('click', '.edit_modal', function() {
        
        $('#timesheet_id').val($(this).data("id"));
        $('#timesheet_title_edit').val($(this).data("title"));
        $('#start_time_edit').val($(this).data("start_time"));
        $('#end_time_edit').val($(this).data("end_time"));
        $('#description_edit').val($(this).data("description"));
        var project_id = $(this).data("project");
        
        $('#project_list_edit1 option[value=' + project_id + ']').prop('selected', true);
        
        updateTaskList(project_id, "#task_list_edit1");
        var task_id = $(this).data("task_id");
        $('#task_list_edit1 option[value=' + task_id + ']').prop('selected', true);

        $('.selectpicker').selectpicker('refresh');
        $('#timesheetEditModal').modal('show');
    });

    
    $("#editTimesheet").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'put',
            url: "timesheets/update",
            data: $(this).serialize(),
            success: function (data) {
                //alert(data);
                $('#timesheetEditModal').modal('hide');
                //alert(JSON.stringify(data));
                location.reload(true);
            },
            error: function (a, b, c) {
                console.log(b);
            },
            complete: function (data) {
                 console.log(data);
            }
        });
    });
    
    $('#project_list1').change(function(){ 
        
        updateTaskList($('#project_list1').find('option:selected').val(), "#task_list1"); 
    });

    $('#project_list_edit1').change(function(){ 
        updateTaskList($('#project_list_edit1').find('option:selected').val(), "#task_list_edit1"); 
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

    </script>
@endsection