<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'class',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'photo',
    ];
}