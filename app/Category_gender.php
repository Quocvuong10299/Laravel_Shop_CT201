<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_gender extends Model
{
    protected $table = 'category_gender';
    public $timestamps = false;
    public function Product(){
        return $this->hasMany("App\Product","category_gender_id");
    }
    protected $primaryKey = 'category_gender_id';
}
