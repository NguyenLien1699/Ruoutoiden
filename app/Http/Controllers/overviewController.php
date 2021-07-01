<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Utilitys\utilitys;
use App\Models\settings;

class overviewController extends Controller
{
    public function index() {
        return view('overview.index');
    }
}
