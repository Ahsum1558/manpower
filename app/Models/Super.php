<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Super extends Authenticatable
{
    use HasFactory;

    protected $guard = 'super';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];
}
