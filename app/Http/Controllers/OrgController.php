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

    /**
     * 添加
     *
     */
    public function create($id)
    {
        $org = Org::findOrFail($id);

        return view('org.create', compact('org'));
    }

    /**
     * 添加
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => ['required','alpha_dash', 'min:3', 'max:16'], # 英文数字下划线
            'name' => ['required', 'min:3', 'max:12'],
        ]);

        if(Org::where('key', $request->key)->first()) return redirect()->back()->withInput()->withErrors(['key' => ['key已经存在']]);
        if(Org::where('info->name', $request->name)->first()) return redirect()->back()->withInput()->withErrors(['name' => ['名称已经存在']]);

        print_r($request->all());

        $parent = Org::findOrFail($request->id);

        $parent->children()->create(['key' => $request->key, 'info->name' => $request->name, 'type' => 'branch']);

        return redirect('/orgs');
    }
}
