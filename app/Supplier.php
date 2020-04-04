<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    public $timestamps = false;
    public function Product(){
        return $this->hasMany("App\Product","supplier_id");
    }
    public function Import_coupon(){
        return $this->hasMany("App\Import_coupon","supplier_id");
    }
    protected $primaryKey = 'supplier_id';
}
