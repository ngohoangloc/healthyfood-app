<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.pages.area');
    }
}
