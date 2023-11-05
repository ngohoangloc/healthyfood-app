<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodReceivedNoteController extends Controller
{
    public function index()
    {
        return view('admin.pages.good-received-note');
    }
}
