<form method='post' action='{{route('users.update',['id'=>$user->id])}}' enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-6" >
			<input type="text" name="name" class="form-control" placeholder="User Name" value="{{old('name')??$user->name}}" required>
		</div>
		<div class="col-md-6" >
			<input type="email" name="email" class="form-control" placeholder="User Email" value="{{old('email')??$user->email}}" required>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6" >
			<input type="password" name="password" class="form-control" placeholder="User Password" value="{{old('password')}}">
		</div>
		<div class="col-md-6" >
			<input type="password" name="password_confirm" class="form-control" placeholder="User Password Confirmation" value="{{old('password_confirm')}}">
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6" >
			@include('layout.dropdowns.roles', [
				'extensions' => [
				    [
				        'name' => 'required',
				        'value' => 'true',
				    ],
				],
				'selected' => old('role')??$user->role_id,
			])
		</div>
		<div class="col-md-6" >
			<input type="file" name="image" class="form-control">
		</div>
	</div>
	<br>
	<div class="row">
		<button type="submit" class="btn btn-primary btn-icon-split btn-block">
            <span class="icon text-white-50">
            	<i class="fas fa-save"></i>
            </span>
            <span class="text">Save</span>
        </button>
	</div>
</form>