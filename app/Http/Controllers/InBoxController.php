<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InBoxController extends Controller
{

    /**
     * InBoxController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $messages = user()->messages->groupBy('from_user');
        return view('inbox.index',compact('messages'));
    }
}
