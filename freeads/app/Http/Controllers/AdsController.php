<?php

namespace App\Http\Controllers;

use App\Ads;
use App\AdsORM;
use App\Forms\AdsForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;

class AdsController extends Controller
{
    private $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
        $this->middleware("auth");
    }

    private function getForm(bool $modify = false)
    {
        $modify ? $route = "modifyAds" : $route = "sendAds";
        return $this->formBuilder->create(AdsForm::class, [
            "method" => "POST",
            "route" => $route
        ]);
    }

    public function create()
    {
        $form = $this->getForm();
        return view("ads.create", compact("form"));
    }

    public function send()
    {
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $values = $form->getFieldValues();
        $imageName = time().'.png';
        rename($values["photo"]->path(), public_path('images')."/".$imageName);
        $values["photo"] = $imageName;
        $values["id_user"] = Auth::id();
        $model = new Ads($values);
        $model->save();
        return redirect()->route("home");
    }

    public function list()
    {
        $ads = json_encode(AdsORM::where("id_user", "=", Auth::id())->get());
        return view("ads.my", compact("ads"));
    }

    public function delete(string $id)
    {
        if(AdsORM::where("id", "=", $id)->get()[0]["id_user"] === Auth::id()) {
            AdsORM::find($id)->delete();
            return redirect()->route("myAds");
        }
        else echo "Error not your ad";
    }

    public function modify(string $id)
    {
        $ads = AdsORM::where("id", "=", $id)->get();
        if($ads[0]["id_user"] === Auth::id())
            return view("ads.modify", ["ads" => $ads]);
        else echo "Error not your ad";
    }

    public function modifyRequest()
    {
        $tab = [];
        $id = $_GET["id"];
        unset($_GET["id"]);
        $ads = AdsORM::where("id", "=", $id)->get();
        if($ads[0]["id_user"] === Auth::id()) {
            AdsORM::findOrFail($id)->update($_GET);
            return redirect()->route("myAds");
        }
        else echo "Error not your ad";
    }
}
