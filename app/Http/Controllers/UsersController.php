<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers;

class UsersController  extends Controller
{
	public function index()
	{
		dd('index');
	}
	public function login(Request $request)
	{
		dd($request->all());
	}
}

?>
