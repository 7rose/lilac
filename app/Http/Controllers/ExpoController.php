<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RoleTrait;

class ExpoController extends Controller
{
    public function index()
    {
        return view('expo.index');
    }

    public function create()
    {
        return view('expo.create');
    }
}
