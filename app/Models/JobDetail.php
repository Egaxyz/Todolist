<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    protected $table = 'job_detail';
    protected $fillable = [
        'job_id',
        'priority',
        'start_date',
        'end_date',
        'attachment_url',
    ];
}