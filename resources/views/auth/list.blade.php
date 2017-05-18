@extends('app')
@section('content')
<!-- title start -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="">User List</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home</a></li>
                <li><i class="icon_document_alt"></i>User List</li>
            </ol>
        </div>
    </div>
    <!-- title end -->
    <!-- main Content start -->
    <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-responsive-margin">
                            @if (count($user_list) > 0)
                            <table id="dataTables-example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        
                                        <th>Create Date</th>
                                        <th data-priority="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_list as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>@if($user->user_role == 1) Admin @else Developer @endif</td>
                                        
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ url('users/edit/'.$user->id) }}">Edit</a></li>
                                                    <li>

                                                    <a href="{{ url('users/delete/'.$user->id) }}" class="confirmation">Delete</a></li>
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
   <script>
    $('.confirmation').on('click', function (e) {
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this info again",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            
        },
        function(isConfirm) {
            //alert(isConfirm);
            //return true;
            if (isConfirm) {
                
                swal({
                    title: 'Deleted',
                    text: 'User has successfully deleted',
                    type: 'success'
                }, function() {
                    
                });

            } 
        });
        //return confirm('Are you sure?');
    });
     
</script>
@endsection