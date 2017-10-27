<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public function item(){
        return $this->belongsTo('\App\Item','item_id','id');
    }

    public function criterion(){
        return $this->belongsTo('\App\Criterion','criterion_id','id');
    }

    public function user(){
        return $this->belongsTo('\App\User','user_id','id');
    }
}
