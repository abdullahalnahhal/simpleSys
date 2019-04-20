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
        <!-- <h6 class="m-0 font-weight-bold text-primary pull-left">Users Table</h6> -->
        <a href="{{route('users.new')}}" class="btn btn-success btn-icon-split pull-right">
            <span class="icon text-white-50">
              <i class="far fa-plus-square"></i>
            </span>
            <span class="text">New</span>
        </a>
    </div>
	<div class="card-body">
	    @include('layout.tables.users.index')
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