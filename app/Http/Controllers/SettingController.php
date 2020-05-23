<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * set personal profiles public
     *
     */
    public function pub(Request $request)
    {
        // $request->validate([
        //     'pub' => ['boolean'],
        // ]);

        Auth::user()->update(['info->public' => $request->pub == 'true' ? true : false]);
        return json_encode(['checked' => $request->pub]);
    }
}
