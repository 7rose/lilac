<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpoController extends Controller
{
    public function index()
    {
        return view('expos');
    }
}
