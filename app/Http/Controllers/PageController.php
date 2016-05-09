<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest');
    }

    public function page($slug)
    {
        return view('pages.'.$slug);
    }
}
