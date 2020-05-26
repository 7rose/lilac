<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RoleTrait;

class ExpoController extends Controller
{

    protected $a;

    public function index()
    {
        // if(is_null($this->a)) echo "is_null....";
        // if(empty($this->a)) echo "empty....";
        // if(isset($this->a)) echo "isset....";
        // $this->target = "yes";
        // $this->higher_than = 'fuck';
        return $this->higher();
        // return $this->a()->c();
        // return view('expos');
    }
}
