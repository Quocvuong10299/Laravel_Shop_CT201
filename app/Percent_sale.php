<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Percent_sale extends Model
{
    protected $table = 'percent_sale';
    public $timestamps = false;
    public function Price(){
        return $this->hasMany('App\Price','percent_value');
    }
    protected $primaryKey = 'percent_value';
}
