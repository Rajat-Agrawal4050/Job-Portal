<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function job(){
        return $this->belongsTo(AllJob::class);
    }
}
