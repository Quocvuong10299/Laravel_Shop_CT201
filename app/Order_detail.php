<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_detail';
    public $timestamps = false;
    public function Product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public function Order(){
        return $this->belongsTo('App\Order','order_id');
    }
    protected $primaryKey = ['orders_detail_id','order_id'];
}
