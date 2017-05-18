@extends('app')

@section('content')
    <!-- title start    -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
                <li><i class="icon_document_alt"></i>Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- title end -->
    <!-- main Content start -->
    <div class="row">
        <div class="project-button col-md-12">
            <button type="button" class="btn btn-default btn-lg dashboard-btn">
              <a href="#">Overview</a>
            </button>
            <button type="button" class="btn btn-default btn-lg dashboard-btn">
              <a href="#">Overview</a>
            </button>
            <button type="button" class="btn btn-default btn-lg dashboard-btn">
              <a href="#">Overview</a>
            </button>
            <button type="button" class="btn btn-default btn-lg dashboard-btn">
              <a href="#">Overview</a>
            </button>
            <button type="button" class="btn btn-default btn-lg dashboard-btn">
              <a href="#">Overview</a>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Today Scheduled Tasks
                    <div class="pull-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Hrs (E)</th>
                                    <th>Hrs (S)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Artdata - Art of Management</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Artdata - Art of Management</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Artdata - Art of Management</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Open Issue
                    <div class="pull-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Issue Name</th>
                                    <th>Hrs (E)</th>
                                    <th>Hrs (S)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Image Upload Problem</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Image Upload Problem</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                                <tr class="clickable-row" data-href="index.php">
                                    <td>Image Upload Problem</td>
                                    <td>8</td>
                                    <td>4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Recent Activity</div>
              <!-- List group -->
              <div class="list-group" style="height: 200px; overflow-y: scroll;">
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>

                <a href="#" class="list-group-item"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><span class="text-muted"><i class="fa fa-clock-o fa-fw"></i> 05:23 am 09/11/2016</span></a>
              </div>
            </div>
        </div>                    
    </div>

   <!-- main Content end  -->
@endsection
