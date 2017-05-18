<!-- Sidebar Start-->
                @if ( ! Auth::guest() )
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <!-- search start -->
                            <li class="sidebar_search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" style="padding: 9px 12px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div> 
                            </li>
                            <!-- search end  -->
                            <li >
                                <a href="{{ URL::to('/') }}">Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Projects<span class="fa arrow"></span></a>
                                <ul class="nav">
                                    <li>
                                        <a href="{{ URL('projects/create') }}">Add Project</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL('projects') }}">Project List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL('tasks?project=all') }}">Task List</a>
                                    </li>                                    
                                    <li>
                                        <a href="{{ URL('issues') }}">Issue List</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL('timesheets') }}">Time Sheet</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Team/Users<span class="fa arrow"></span></a>
                                <ul class="nav">
                                    <li>
                                        <a href="{{ URL('auth/register') }}">Add Users</a>
                                        <a href="{{ URL('users/user_list') }}">Users List</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="#">Reports<span class="fa arrow"></span></a>
                                <ul class="nav">
                                    <li>
                                        <a href="{{ URL('reports/project_list') }}">Project wise</a>
                                        <a href="">Resource wise</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
                <!-- Sidebar End -->