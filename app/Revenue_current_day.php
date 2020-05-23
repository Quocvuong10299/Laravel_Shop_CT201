<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue_current_day extends Model
{
    protected $table = 'revenue_current_day';
    public $timestamps = false;
//    public function Product_attribute(){
//        return $this->hasMany('App\Product_attribute','size_value');
//    }
    protected $primaryKey = 'revenue_current_day_id';
}
