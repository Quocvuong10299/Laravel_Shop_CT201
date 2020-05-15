<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    public $timestamps = false;
    public function Product_attribute(){
        return $this->hasMany('App\Product_attribute','color_value');
    }
    protected $primaryKey = 'color_value';
}
