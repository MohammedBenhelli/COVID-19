<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdsForm extends Form
{
    public function buildForm()
    {
        $this->add("title", "text", ["rules" => "required|min:4"])
            ->add("description", "textarea", ["rules" => "required|min:15"])
            ->add("photo", "file", ["rules" => "required"])
            ->add("price", "number", ["rules" => "required"])
            ->add("submit", "submit");
    }
}
