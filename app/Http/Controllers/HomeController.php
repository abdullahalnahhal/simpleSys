<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Controllers;

class HomeController  extends Controller
{
	public function index()
	{
		return view('app.index');
	}

}

?>
