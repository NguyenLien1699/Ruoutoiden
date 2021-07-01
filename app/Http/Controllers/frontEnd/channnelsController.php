<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class channnelsController extends Controller
{
    public function index(){
        return View('index');
    }
}
