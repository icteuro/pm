@extends('app')
@section('content')
<!-- main Content start -->      
    <div class="row">
        <div class="col-md-12">
            @if (count($projects[0]) > 0)
                <?php echo '<pre>'; print_r($projects[0]); echo '</pre>'; ?>
                
                    <div class="overview-project-name">
                        <div class="col-md-12">
                            <h3>{{ $projects[0]->project_name }}</h3>
                            <hr/>
                        </div>
                        <div class="col-md-4">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Project Overview</h4>
                                    <p> 
                                        Estimated Start Date: {{ $projects[0]->estimated_start_date }} <br>
                                        Actual Start Date: -- <br>
                                        Estimated Deadline: {{ $projects[0]->target_deadline }}<br>
                                        Status: 
                                            @if ($projects[0]->status == 1) Pending
                                                @elseif ($projects[0]->status == 2) Ongoing
                                                @elseif ($projects[0]->status == 3) Complete
                                                @elseif ($projects[0]->status == 4) Paused
                                            @endif
                                        <br>
                                        Total Time Spent: --
                                        <br>
                                        Total Team Member: {{ $projects[0]->total_user }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="media border-right">
                                
                                <div class="media-body">
                                    <h4 class="media-heading">Project Description</h4>
                                    <p> 
                                        {{ $projects[0]->project_description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="media-body">
                                <h4 class="media-heading">Issues Overview</h4>
                                <p> 
                                    Total Issues: {{ $projects[0]->total_issues }} <br>
                                    Pending: {{ $projects[0]->pending_issues }} <br>
                                    Ongoing: {{ $projects[0]->ongoing_issues }} <br>
                                    Completed: {{ $projects[0]->completed_issues }}<br>
                                    Estimated Hrs:  {{ $projects[0]->total_estimated_issues ? $projects[0]->total_estimated_issues : 0 }}<br>
                                    
                                </p>

                            </div>
                        </div>
                        <!--<div class="col-md-3">
                            <div class="media-body">
                                <canvas id="myChart" width="1000" height="400"></canvas>
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="media-body">
                                <h4 class="media-heading">Issues Overview</h4>
                                <p> 
                                    Total Issues: {{ $projects[0]->total_issues }} <br>
                                    Pending: {{ $projects[0]->pending_issues }} <br>
                                    Ongoing: {{ $projects[0]->ongoing_issues }} <br>
                                    Completed: {{ $projects[0]->completed_issues }}<br>
                                    Estimated Hrs:  {{ $projects[0]->total_estimated_issues ? $projects[0]->total_estimated_issues : 0 }}<br>
                                    
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="media-body">
                                <h4 class="media-heading">Issues Overview</h4>
                                <p> 
                                    Total Issues: {{ $projects[0]->total_issues }} <br>
                                    Pending: {{ $projects[0]->pending_issues }} <br>
                                    Ongoing: {{ $projects[0]->ongoing_issues }} <br>
                                    Completed: {{ $projects[0]->completed_issues }}<br>
                                    Estimated Hrs:  {{ $projects[0]->total_estimated_issues ? $projects[0]->total_estimated_issues : 0 }}<br>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    
                @endif
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext("2d");
        var data = {
            labels: {!! json_encode($projects[0]->ongoing_task) !!},
            datasets: [
                {
                    label: "My Data",                    
                    data: {!! json_encode($projects[0]->pending_task) !!}
                }
            ]
        };
        var myLineChart = new Chart(ctx).Line(data);
    </script>
@endsection
