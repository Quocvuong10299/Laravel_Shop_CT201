<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date_sale extends Model
{
    protected $table = 'date_sale';
    public $timestamps = false;
    public function Price(){
        return $this->hasMany('App\Price','date_id');
    }
    protected $primaryKey = 'date_id';
}
