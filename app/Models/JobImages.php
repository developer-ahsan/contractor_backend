<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobImages extends Model
{
    use HasFactory;

    public function job(){
        return $this->belongsTo('App\Models\Jobs', 'id', 'job_id');
    }
}
