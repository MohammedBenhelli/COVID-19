<?php

namespace App;

use Eloquent;

class UserORM extends Eloquent {
    protected $table = 'users';
    protected $fillable = ['email', 'password'];
}
