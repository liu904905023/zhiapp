<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        return view('user.setting');
    }

    public function store(Request $request) {
        user()->setting()->merge($request->all());

        return back();

    }
}