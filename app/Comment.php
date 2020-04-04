<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
    public function Product(){
        return $this->belongsTo('App\Product','product_id');
    }
    protected $primaryKey = 'comment_id';
}
