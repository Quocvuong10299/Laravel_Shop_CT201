<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Price extends Model
{
    protected $table = 'date_sale';
    public $timestamps = false;
    public function Date_sale(){
        return $this->belongsTo('App\Date_sale','date_id');
    }
    public function Product(){
        return $this->belongsTo('App\Product','product_id');
    }
    public function Percent_sale(){
        return $this->belongsTo('App\Percent_sale','percent_value');
    }

    protected $primaryKey = ['date_id','percent_value','product_id'];

}
