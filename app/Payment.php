<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    public function Order(){
        return $this->hasMany('App\Order','payment_id');
    }
    protected $primaryKey = 'payment_id';
}
