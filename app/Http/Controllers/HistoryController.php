<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        // get campaign Cookie
//        $campaign_cookie = \Cookie::get('campaign');
//        if (!$campaign_cookie) {
//            $this->middleware('auth');
//        }

    }

    public function index(){
        return view('history.index');
    }
}
