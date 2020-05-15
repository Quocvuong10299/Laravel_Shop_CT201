<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import_coupon extends Model
{
    protected $table = 'import_coupon';
    public function Product_attribute(){
        return $this->hasMany('App\Product_attribute','coupon_id');
    }
    public function Supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    protected $primaryKey = 'coupon_id';
}
