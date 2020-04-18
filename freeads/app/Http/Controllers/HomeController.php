<?php

namespace App\Http\Controllers;

use App\AdsORM;
use App\Ads;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        if(User::find(Auth::id())->getAttributes()["email_verified_at"] === null)
            return view('home');
        else {
            $ads = json_encode(AdsORM::where("id_user", "!=", Auth::id())->get());
            return view('acceuil', compact("ads"));
        }
    }

    public function showModify()
    {
        $user = User::find(Auth::id())->getAttributes();
        return view("auth.modify", compact("user"));
    }

    public function modify()
    {
        if($_GET["pass"] === $_GET["passConf"] && strlen($_GET["passConf"]) > 5) {
            User::find(Auth::id())->update(["password" => Hash::make($_GET["pass"]), "email" => $_GET["email"]]);
            Auth::logout();
            return redirect('/home');
        }
        else if ($_GET["pass"] === $_GET["passConf"]) {
            User::find(Auth::id())->update(["email" => $_GET["email"]]);
            Auth::logout();
            return redirect('/home');
        }
        else {
            $user = User::find(Auth::id())->getAttributes();
            return view("auth.modify", compact("user"));
        }
    }
}
