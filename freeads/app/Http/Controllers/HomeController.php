<?php

namespace App\Http\Controllers;

use App\AdsORM;
use App\Ads;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function showHome()
    {
        $ads = json_encode(AdsORM::all());
        return view('acceuil', compact("ads"));
    }
}
