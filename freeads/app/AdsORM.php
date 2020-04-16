<?php

namespace App;

use Eloquent;

class AdsORM extends Eloquent {
    protected $table = 'ads';
    protected $fillable = ['title', 'description', 'price'];
}
