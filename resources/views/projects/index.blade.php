@extends('app')
@section('content')
<!-- title start -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Projects List</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
                <li><i class="icon_document_alt"></i>Projects List</li>
            </ol>
        </div>
    </div>
    <!-- title end -->
    <!-- main Content start -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active_projects" data-toggle="tab">Active Projects</a></li>
                        <li><a href="#upcoming_projects" data-toggle="tab">Upcoming Projects</a></li>
                        <li><a href="#closed_projects" data-toggle="tab">Closed Projects</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="active_projects">
                            <?php //print_r($user->id); ?>

                            @if (count($active_projects) > 0)
	                            <table id="dataTables-example1" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr>
                                            <th data-priority="1">Project ID</th>
	                                        <th >Project Name</th>
	                                        <th>Hours Spent</th>
	                                        <th>Open Tasks</th>
	                                        <th>Open Issues</th>
	                                        <th>Create Date</th>
	                                        <th data-priority="1">Action</th>
	                                    </tr>
	                                </thead>

	                                <tbody>
                                    <?php //echo '<pre>';print_r($projects);?>
	                                    @foreach($active_projects as $project)
		                                    <tr row_id="{{ $project->id }}">
                                                <td>{{ $project->id }}</td>
		                                        <td><a href="{{ url('projects/'.$project->id) }}">{{ $project->project_name }}</a></td>
		                                        <td>102</td>
		                                        <td>1</td>
		                                        <td>5</td>
		                                        <td>{{ $project->created_at }}</td>
		                                        <td>
		                                            <div class="dropdown">
		                                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		                                                Action
		                                                <span class="caret"></span>
		                                              </button>
		                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		                                                <li><a href="{{ url('projects/'.$project->id.'/edit') }}">Edit</a></li>
		                                                
		                                                <li><a href="#">Status</a></li>
		                                                <li><a href="{{ url('projects/'.$project->id) }}">Details</a></li>
                                                        <li><a href="{{ url('projects/'.$project->id) }}" class="delete_confirm" data-id="{{ $project->id }}">Delete</a></li>
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
                        <div class="tab-pane fade" id="upcoming_projects">
                            @if ($upcoming_projects)
                            <table id="dataTables-example2" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Project ID</th>
                                        <th>Project Name</th>
                                        <th>Hours Spent</th>
                                        <th>Open Tasks</th>
                                        <th>Open Issues</th>
                                        <th>Create Date</th>
                                        <th data-priority="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcoming_projects as $upcoming_project)
                                    <tr row_id="{{ $upcoming_project->id }}">
                                        <td>{{ $upcoming_project->id }}</td>
                                        <td>{{ $upcoming_project->project_name }}</td>
                                        <td>102</td>
                                        <td>1</td>
                                        <td>5</td>
                                        <td>{{ $upcoming_project->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="{{ url('projects/'.$upcoming_project->id.'/edit') }}">Edit</a></li>
                                                
                                                <li><a href="#">Status</a></li>
                                                <li><a href="{{ url('projects/'.$upcoming_project->id) }}">Details</a></li>
                                                <li><a href="{{ url('projects/'.$upcoming_project->id) }}" class="delete_confirm" data-id="{{ $upcoming_project->id }}">Delete</a></li>
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
                        <div class="tab-pane fade" id="closed_projects">
                            @if ($closed_projects)
                            <table id="dataTables-example3" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Project ID</th>
                                        <th>Project Name</th>
                                        <th>Hours Spent</th>
                                        <th>Open Tasks</th>
                                        <th>Open Issues</th>
                                        <th>Create Date</th>
                                        <th data-priority="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($closed_projects as $closed_project)
                                    <tr row_id="{{ $closed_project }}">
                                        <td>{{ $closed_project->id }}</td>
                                        <td>{{ $closed_project->project_name }}</td>
                                        <td>102</td>
                                        <td>1</td>
                                        <td>5</td>
                                        <td>{{ $closed_project->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="{{ url('projects/'.$closed_project->id.'/edit') }}">Edit</a></li>
                                                
                                                <li><a href="#">Status</a></li>
                                                <li><a href="{{ url('projects/'.$closed_project->id) }}">Details</a></li>
                                                <li><a href="{{ url('projects/'.$closed_project->id) }}" class="delete_confirm" data-id="{{ $closed_project->id }}">Delete</a></li>
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
            </div>
        </div>
    </div>
   <!-- main Content end --> 
@endsection