<select name="role" class="form-control"
@if(isset($extensions))
    @foreach($extensions as $extension)
    	{{$extension['name']}} = {{$extension['value']}}
    @endforeach
@endif
>
	@foreach(App\Models\Roles::all() as $role)
	    <option value="{{$role->id}}" @if($selected && $selected == $role->id) selected @endif>{{$role->role}}</option>
	@endforeach
</select>