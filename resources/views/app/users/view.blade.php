@extends('layout.main')
@push('css')
<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('title', 'Users|'.$user->name)
@section('content')
<h1 class="h3 mb-4 text-gray-800">{{$user->name}}</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @can('delete', $user)
        <a href="javascript:void(0)" class="btn btn-danger btn-circle command" command='confirm' action='url' url="{{route('users.delete', ['id'=>$user->id])}}" message="Are You Sure You Want To Remove These Item ...?">
            <i class="fas fa-trash"></i>
        </a>
        @endcan
        @can('update', $user)
        <a href="{{route('users.edit', ['id'=>$user->id])}}" class="btn btn-primary btn-circle">
            <i class="fas fa-edit"></i>
        </a>
        @endcan
    </div>
	<div class="card-body">
	    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                    @if($user->img)
                        <img src="{{asset('uploads/'.$user->img)}}" class="img-fluid" alt="Responsive image">
                    @else
                        <img src="{{asset('img/admin.png')}}" class="img-fluid" alt="Responsive image">
                    @endif
              </div>
              <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{$user->name}}</h1>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            <div class="h4 text-gray-900 mb-4">{{$user->email}}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            <div class="h4 text-gray-900 mb-4">{{$user->role->role}}</div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
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
