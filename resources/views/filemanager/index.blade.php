<div class="row">
    <div class="col-md-12">
        <div class="table-responsive table-responsive-margin">
            @if (count($files) > 0)
            <table id="dataTables-example1" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Uploaded By</th>
                        <th>Upload Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr row_id="{{$file->id}}">
                        <td>
                            <a href="{{ url('uploads/filemanager/'.$file->filename) }}" data-id="{{ $file->id }}" target="_blank">
                                {{$file->filename}}
                            </a>
                        </td>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->created_at }}</td>
                        <td>
                            
                            
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('uploads/filemanager/'.$file->filename) }}" data-id="{{ $file->id }}" target="_blank">Download</a></li>
                                    @if($user_id == $file->created_by)
                                    <li><a href="{{ url('filemanager/'.$file->id) }}" class="delete_confirm" data-id="{{ $file->id }}">Delete</a></li>
                                    @endif
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