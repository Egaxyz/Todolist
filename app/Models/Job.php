<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected $fillable = [
        'name',
        'description',
        'type_id',
        'user_id',
        'status',
    ];
}
