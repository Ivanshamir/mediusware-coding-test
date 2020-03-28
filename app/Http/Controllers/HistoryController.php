<?php

namespace Bulkly\Http\Controllers;

use Bulkly\BufferPosting;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        // get campaign Cookie
        $campaign_cookie = \Cookie::get('campaign');
        if (!$campaign_cookie) {
            $this->middleware('auth');
        }

    }

    public function index(){
        return view('history.index');
    }

    public function bufferResult(){
        $result =  BufferPosting::with('groupInfo', 'accountInfo')->paginate(50);
        return response()->json($result);
    }
}
