<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected $fillable = [
        'type_id',
        'user_id',
        'name',
        'due_to',
        'status',
        'description',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function details()
    {
        return $this->hasMany(JobDetail::class, 'job_id');
    }
}