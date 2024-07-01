<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrators extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "administrators";

    protected $fillable = [
        "name",
        "email",
        "password",
        "role"
    ];
}
