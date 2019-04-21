<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	    <thead>
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>email</th>
	            <th>role</th>
	            <th>Action</th>
	        </tr>
	    </thead>
	    <tfoot>
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>email</th>
	            <th>role</th>
	            <th>Action</th>
	        </tr>
	    </tfoot>
        <tbody>
        	@php
        		$counter = 1;
        	@endphp
        	@foreach($users as $user)
            <tr>
            	<td>{{$counter++}}</td>
	            <td>{{$user->name}}</td>
	            <td>{{$user->email}}</td>
	            <td>{{$user->role->role}}</td>
	            <td>
	            	<a href='javascript:void(0)' class="btn btn-danger btn-circle btn-sm command" command='confirm' action='url' url="{{route('users.delete', ['id'=>$user->id])}}" message='Do You Want Realy To Delete These Item'>
                        <i class="fas fa-trash"></i>
                    </a>
                    <a href="{{route('users.edit', ['id'=>$user->id])}}" class="btn btn-primary btn-circle btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{route('users.view', ['id'=>$user->id])}}" class="btn btn-success btn-circle btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
	        </tr>
	        @endforeach
        </tbody>
    </table>
</div>