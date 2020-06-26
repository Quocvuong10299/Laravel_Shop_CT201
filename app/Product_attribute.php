<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    protected $table = 'product_attribute';
    public $timestamps = false;
    public function Size(){
        return $this->belongsTo('App\Size','size_value');
    }
    public function Color(){
        return $this->belongsTo('App\Color','color_value');
    }
    public function Product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public function Import_coupon(){
        return $this->belongsTo('App\Import_coupon','coupon_id');
    }
//    protected $primaryKey = ['size_value','color_value','product_id','coupon_id'];
    protected $primaryKey = 'size_value';

}
