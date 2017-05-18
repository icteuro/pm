@extends('app')
@section('content')
<!-- main Content start -->      
    <div class="row">
        <div class="col-md-12">
            @if (count($projects) > 0)
                <?php //echo '<pre>'; print_r($projects); echo '</pre>'; ?>
                @foreach($projects as $project)
                    <div class="overview-project-name">
                        <div class="col-md-12">
                            <h3><a href="{{ URL('reports/project_detail/'.$project->id) }}">{{ $project->project_name }}</a></h3>
                            <hr/>
                        </div>
                        <div class="col-md-4">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Project Overview</h4>
                                    <p> 
                                        Estimated Start Date: {{ $project->estimated_start_date }} <br>
                                        Actual Start Date: -- <br>
                                        Estimated Deadline: {{ $project->target_deadline }}<br>
                                        Status: 
                                            @if ($project->status == 1) Pending
                                                @elseif ($project->status == 2) Ongoing
                                                @elseif ($project->status == 3) Complete
                                                @elseif ($project->status == 4) Paused
                                            @endif
                                        <br>
                                        Total Time Spent: --
                                        <br>
                                        Total Team Member: {{ $project->total_user }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Tasks Overview</h4>
                                    <p> 
                                        Total Tasks: {{ $project->total_task }} <br>
                                        Pending: {{ $project->pending_task }} <br>
                                        Ongoing: {{ $project->ongoing_task }} <br>
                                        Completed: {{ $project->completed_task }}<br>
                                        Estimated Hrs:  {{ $project->total_estimated_task ? $project->total_estimated_task : 0 }}<br>
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="media-body">
                                    <h4 class="media-heading">Issues Overview</h4>
                                    <p> 
                                        Total Issues: {{ $project->total_issues }} <br>
                                        Pending: {{ $project->pending_issues }} <br>
                                        Ongoing: {{ $project->ongoing_issues }} <br>
                                        Completed: {{ $project->completed_issues }}<br>
                                        Estimated Hrs:  {{ $project->total_estimated_issues ? $project->total_estimated_issues : 0 }}<br>
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection
