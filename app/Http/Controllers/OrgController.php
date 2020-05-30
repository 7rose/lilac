<?php

namespace App\Http\Controllers;

use App\Org;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    /**
     * 机构树
     *
     */
    public function index()
    {
        $this->authorize('manage', Org::class);

        return view('org.tree');
    }
}
