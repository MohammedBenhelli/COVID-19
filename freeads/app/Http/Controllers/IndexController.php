<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class IndexController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }
}