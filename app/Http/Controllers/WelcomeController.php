<?php

namespace project2\Http\Controllers;

use Illuminate\Http\Request;

use project2\Http\Requests;

class WelcomeController extends Controller
{
    public function index()
    {
    	return view('welcome');
    }
}
