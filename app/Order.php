<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;
    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
    public function Payment(){
        return $this->belongsTo('App\Payment','payment_id');
    }
    public function Order_detail(){
        return $this->hasMany('App\Order_detail','order_id');
    }
    protected $primaryKey = 'order_id';
}
