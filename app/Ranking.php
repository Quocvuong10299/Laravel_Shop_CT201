<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';
    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
    public function Product(){
        return $this->belongsTo('App\Product','product_id');
    }
    protected $primaryKey = 'ranking_id';
}
