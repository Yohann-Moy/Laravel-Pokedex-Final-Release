<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    //protected $guarded = [];
    //
}
