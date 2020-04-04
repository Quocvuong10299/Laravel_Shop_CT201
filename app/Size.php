<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    public $timestamps = false;
    public function Product_attribute(){
        return $this->hasMany('App\Product_attribute','size_value');
    }
    protected $primaryKey = 'size_value';
}
