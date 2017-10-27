<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterating extends Model
{
    //
    public function criteria(){
        return $this->hasMany('App\Criterion');
    }

    public function items(){
        return $this->hasMany('\App\Item');
    }

    public function owner(){
        return $this->hasOne('\App\User');
    }
}
