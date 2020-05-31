<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'title' => ['required','string', 'min:4', 'max:16'],
            'addr' => ['required', 'min:6', 'max:100'],
            'begin' => ['required', 'after:'.today()],
            'end' => ['required', 'after:'.today()],
            'price' => ['required', 'numeric', 'min:0', 'max:1000'],
            'manager' => ['max:110'],
            'checker' => ['max:110'],
        ]);



        print_r($request->all());


    }

}
