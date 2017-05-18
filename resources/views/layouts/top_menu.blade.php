<!-- Top Menu start -->
    <ul class="nav navbar-right navbar-top-links">
        <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li> -->
        <!-- user menu start -->
        <!--<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-link" aria-hidden="true"></i> Quick Links<b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#">Quick Links 1</a></li>
                <li><a href="#">Quick Links 1</a></li>
                <li><a href="#">Quick Links 1</a></li>
                <li><a href="#">Quick Links 1</a></li>
            </ul>
        </li>-->
        @if ( Auth::guest() )
        <!-- user menu start -->
        <li class="dropdown">
            <a href="{{ url('auth/login') }}">
                <i class="fa fa-user fa-fw"></i> Login
            </a>
        </li>
        @else
        <!-- user menu start -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}<b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                
                <li><a href="#"><i class="fa fa-user fa-fw"></i> View Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Edit</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
                
            </ul>
        </li>
        @endif
        <!-- user menu end  -->
    </ul>
    <!-- Top Menu end-->