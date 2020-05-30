<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RoleTrait;

class ExpoController extends Controller
{
    /**
     * 展会列表
     *
     */
    public function index()
    {
        return view('expo.index');
    }

    /**
     * 发布
     *
     */
    public function create()
    {
        return view('expo.create');
    }

    /**
     * 发布保存
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:4', 'max:16'],
            'addr' => ['required', 'min:6', 'max:100'],
            'begin' => ['required', 'datetime'],
            'end' => ['required', 'datetime'],
            'price' => ['required', 'datetime'],
            'addr' => ['accepted'],
        ]);
    }
}
