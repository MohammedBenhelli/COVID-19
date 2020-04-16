<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value)
            $this->$key = $value;
    }
}
