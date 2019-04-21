@extends('layout.main')
@push('css')
<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('title', 'Users')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Users</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @if($action == 'Create')
            <h6 class="m-0 font-weight-bold text-primary">Creat User</h6>
        @else($action == 'Update')
            <h6 class="m-0 font-weight-bold text-primary">Update User : {{$user->name}}</h6>
        @endif
    </div>
	<div class="card-body">
	    @if($action == 'Create')
            @include('layout.forms.create.users')
        @else($action == 'Update')
            @include('layout.forms.update.users')
        @endif
	</div>
</div>
@endsection
@push('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endpush