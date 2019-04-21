<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsersUpdateRequest;

class UsersController  extends Controller
{
	public function index()
	{
		$users = User::all();
		return view('app.users.index',[
			'active' => 'Users',
			'users' => $users,
		]);
	}
	public function new()
	{
		return view('app.users.form',[
			'active' => 'Users',
			'action' => 'Create'
		]);
	}
	public function edit($id)
	{
		$user = User::find($id);
		if (!$user || !$user->count()) {
			return back()->withErrors('Sorry But These User Dosn\'t Exist...!');
		}
		return view('app.users.form',[
			'active' => 'Users',
			'action' => 'Update',
			'user' => $user,
		]);
	}
	public function add(UsersRequest $request)
	{
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->role_id = $request->role;
		if ($request->file('image')) {
			$destinationPath = 'uploads';
      		$file_name = $request->file('image')->move($destinationPath,rand().'_'.$request->file('image')->getClientOriginalName());
			$user->img = $file_name->getBasename();
		}
		if ($user->save()) {
			return redirect()->route('users.index')->with('Created','User Has Been Created ...!');
		}
		return back()->withErrors('Sorry But there Was an issue in saving Data please try again');
	}
	public function update($id, UsersUpdateRequest $request)
	{
		$user = User::find($id);
		if (!$user || !$user->count()) {
			return back()->withErrors('Sorry But These User Dosn\'t Exist...!');
		}
		$user->name = $request->name;
		$user->email = $request->email;
		if (isset($request->password) && $request->password) {
			$user->password = Hash::make($request->password);
		}
		$user->role_id = $request->role;
		if ($request->file('image')) {
			$destinationPath = 'uploads';
      		$file_name = $request->file('image')->move($destinationPath,rand().'_'.$request->file('image')->getClientOriginalName());
			$user->img = $file_name->getBasename();
		}
		if ($user->save()) {
			return redirect()->route('users.index')->with('Updated','User Has Been Updated ...!');
		}
		return back()->withErrors('Sorry But there Was an issue in saving Data please try again');
	}
	public function view($id)
	{
		$user = User::find($id);
		if (!$user || !$user->count()) {
			return back()->withErrors('Sorry But These User Dosn\'t Exist...!');
		}
		return view('app.users.view',[
			'active' => 'Users',
			'user' => $user,
		]);
	}
	public function delete($id)
	{
		$user = User::find($id);
		if (!$user || !$user->count()) {
			return back()->withErrors('Sorry But These User Dosn\'t Exist...!');
		}elseif ($user->delete()) {
			return redirect()->route('users.index')->with('Deleted','User Has Been Deleted ...!');
		}
	}
	public function login(Request $request)
	{
		$credintials = [
			'email'=>$request->email,
			'password'=>$request->password,
		];
		// attempt to log the user in
		$auth = Auth::guard('web')->attempt($credintials);
		// if successful then redirect to their intended location
		if ($auth) {
			// $this->makeSession($request);
			return redirect()->intended(route("home"));
		}
		// if not success return to the login page with the form data
		return redirect()->back()->withErrors('Email Or Password May Be Wrong')->withInput($request->only('email', 'remember'));
	}

	public function logout()
	{
		Auth::guard('web')->logout();
		return redirect()->route('login');
	}
}

?>
