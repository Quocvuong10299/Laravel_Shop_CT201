<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    protected $table = 'products';
    public function Category_gender(){
        return $this->belongsTo("App\Category_gender","category_gender_id");
    }
    public function Supplier(){
        return $this->belongsTo("App\Supplier","supplier_id");
    }
    public function Price(){
        return $this->hasMany("App\Price","product_id");
    }
    public function Category(){
        return $this->belongsTo("App\category","category_id");
    }
    public function Comment(){
        return $this->hasMany("App\Comment","product_id");
    }
    public function Ranking(){
        return $this->hasMany("App\Ranking","product_id");
    }
//    public function product_images(){
//        return $this->hasMany("App\product_images","product_id");
//    }
    public function Order_detail(){
        return $this->hasMany("App\Order_detail","product_id");
    }
    public function Product_attribute(){
        return $this->hasMany("App\Product_attribute","product_id");
    }
    protected $primaryKey='product_id';
    public static function getProductPages(){
        $product_pages = DB::table('products')
            ->join('category', 'products.category_id', '=', 'category.category_id')
            ->select
            ([
                'category.*',
            ])->get();
        return $product_pages;
    }
}
