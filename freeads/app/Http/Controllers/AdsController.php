<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Forms\AdsForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class AdsController extends Controller
{
    private $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    private function getForm()
    {
        return $this->formBuilder->create(AdsForm::class, [
            "method" => "POST",
            "route" => "sendAds"
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
        $model = new Ads($form->getFieldValues());
        $model->save();
        dd($model->photo);
    }
}
