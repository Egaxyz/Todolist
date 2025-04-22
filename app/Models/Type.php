<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $fillable = [
        'name',
        'description',
    ];
    public $timestamps = false;
}