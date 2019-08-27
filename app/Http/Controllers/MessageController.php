<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = "This is a test message";
        return view('messages', compact('messages'));
    }
}
