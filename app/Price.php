<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Price extends Model
{
    protected $table = 'prices';
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

//    protected $primaryKey = ['date_id','percent_value','product_id'];
    protected $primaryKey = 'date_id';
    public static function getProduct(){
        $datas = DB::table('prices')
            ->join('products', 'prices.product_id', '=', 'products.product_id')
            ->join('date_sale', 'prices.date_id', '=', 'date_sale.date_id')
            ->select
            ([
                'prices.unit_price',
                'prices.percent_value',
                'prices.promotion_price',
                'prices.date_id',
                'date_sale.date_start',
                'date_sale.date_end',
                'prices.product_id',
                'products.product_name',
                'products.product_image',
                'products.category_id',
                'products.category_gender_id',
                'products.product_slug',
                'products.product_description',
            ])->get();
        return $datas;
    }
    public static function getProductSale(){
        $datas_sale = DB::table('prices')
            ->join('products', 'prices.product_id', '=', 'products.product_id')
            ->join('date_sale', 'prices.date_id', '=', 'date_sale.date_id')
            ->select
            ([
                'prices.unit_price',
                'prices.percent_value',
                'prices.promotion_price',
                'prices.date_id',
                'date_sale.date_start',
                'date_sale.date_end',
                'prices.product_id',
                'products.product_name',
                'products.product_image',
                'products.category_id',
                'products.category_gender_id',
                'products.product_slug',
                'products.product_description',
            ])
            ->where('prices.date_id','>',1)
            ->get();
        return $datas_sale;
    }
    public static function getProductPaginate(){
        $data_paginate = DB::table('prices')
            ->join('products', 'prices.product_id', '=', 'products.product_id')
            ->join('date_sale', 'prices.date_id', '=', 'date_sale.date_id')
            ->select
            ([
                'prices.unit_price',
                'prices.percent_value',
                'prices.promotion_price',
                'date_sale.date_start',
                'date_sale.date_end',
                'prices.product_id',
                'products.product_name',
                'products.product_image',
                'products.category_id',
                'products.category_gender_id',
                'products.supplier_id',
                'products.product_slug',
            ]);
        return $data_paginate;
    }
    public static function getSearch($search_content){
        $search = DB::table('prices')
            ->join('products', 'prices.product_id', '=', 'products.product_id')
            ->join('date_sale', 'prices.date_id', '=', 'date_sale.date_id')
            ->select
            ([
                'prices.unit_price',
                'prices.percent_value',
                'prices.promotion_price',
                'prices.date_id',
                'date_sale.date_start',
                'date_sale.date_end',
                'prices.product_id',
                'products.product_name',
                'products.product_image',
                'products.category_id',
                'products.category_gender_id',
                'products.product_slug',
                'products.product_description',
            ])
            ->where('products.product_name', 'like', '%' .$search_content. '%')
            ->get();
        return $search;
    }
}
