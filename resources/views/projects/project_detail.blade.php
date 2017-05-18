@extends('app')
@section('content')
<!-- main Content start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="project-button">
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Overview</a>
                            </button>
                            <?php echo '<pre>'; print_r($project[0]); echo '</pre>'; ?>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Task ({{ $project[0]->pending_task+$project[0]->ongoing_task }}/{{ $project[0]->total_task }})</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Issues ({{ $project[0]->pending_issues+$project[0]->ongoing_issues }}/ {{ $project[0]->total_issues }})</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Team &#38; Schedule</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">File/Note (27)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Clarification (2/90)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Milestones (35)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Discussion (450)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Budget &#38; Customer</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <div class="overview-project-name">
                        <div class="col-md-12">
                            <h3>{{ $project[0]->project_name }}</h3>
                            <hr/>
                        </div>
                        <div class="col-md-4">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Project Overview</h4>
                                    <p> 
                                        Estimated Start Date: {{ $project[0]->estimated_start_date }} <br>
                                        Actual Start Date: -- <br>
                                        Estimated Deadline: {{ $project[0]->target_deadline }}<br>
                                        Status: 
                                            @if ($project[0]->status == 1) Pending
                                                @elseif ($project[0]->status == 2) Ongoing
                                                @elseif ($project[0]->status == 3) Complete
                                                @elseif ($project[0]->status == 4) Paused
                                            @endif
                                        <br>
                                        Total Time Spent: --
                                        <br>
                                        Total Team Member: {{ $project[0]->total_user }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Tasks Overview</h4>
                                    <p> 
                                        Total Tasks: {{ $project[0]->total_task }} <br>
                                        Pending: {{ $project[0]->pending_task }} <br>
                                        Ongoing: {{ $project[0]->ongoing_task }} <br>
                                        Completed: {{ $project[0]->completed_task }}<br>
                                        Estimated Hrs:  {{ $project[0]->total_estimated_task ? $project[0]->total_estimated_task : 0 }}<br>
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="media-body">
                                    <h4 class="media-heading">Issues Overview</h4>
                                    <p> 
                                        Total Issues: {{ $project[0]->total_issues }} <br>
                                        Pending: {{ $project[0]->pending_issues }} <br>
                                        Ongoing: {{ $project[0]->ongoing_issues }} <br>
                                        Completed: {{ $project[0]->completed_issues }}<br>
                                        Estimated Hrs:  {{ $project[0]->total_estimated_issues ? $project[0]->total_estimated_issues : 0 }}<br>
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
