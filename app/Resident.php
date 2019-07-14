<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public function resident(){
        return $this->belongsTo('App\Resident');
    }
}
