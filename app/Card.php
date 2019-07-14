<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function resident(){
        return $this->belongsTo('App\Resident');
    }
}
