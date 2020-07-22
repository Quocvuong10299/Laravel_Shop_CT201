<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use function App\Helper\Helper\getDiscount;
use App\Price;
use App\Product;
use DB;
class PagesController extends Controller
{
    public function pageShowAllProduct($gender, $slug){
        $data_products = Price::getProductPaginate()
            ->where('category_gender_id',$gender)
            ->where('category_id',$slug)
            ->where('product_show',1)
            ->paginate(9);
        $data_products->each(function ($dt) {
            getDiscount($dt);
        });
        return view('pages.products',compact('data_products'));
    }
//    API show all product follow gender
    public function showProducFollowGender(Request $request){
        $id_gender = $request->id_gender;
        $sort_value = $request->sort;

        if(isset($sort_value)){
            $product_gender = Price::getProductPaginate()
                ->where('category_gender_id',$id_gender)
                ->orderBy('unit_price',$sort_value)
                ->get();
        }else{
            $product_gender = Price::getProductPaginate()
                ->where('category_gender_id',$id_gender)
                ->get();
        }
        $product_gender->each(function ($dt) {
            getDiscount($dt);
        });
        return response()->json($product_gender);
    }
    //        get supplier
    public function pageProductGender($gender){
        $supplier = DB::table('products')->join('supplier','products.supplier_id','=','supplier.supplier_id')
            ->select(['supplier.supplier_id','supplier.supplier_name'])
            ->where('products.category_gender_id', $gender)
            ->get();
        $collection = collect($supplier);
        $uniqueSupplier = $collection->unique('supplier_name');
        $uniqueSupplier->values()->all();
        return view('pages.productsCatelog',compact('uniqueSupplier'));
    }
    //    API supplier products
    public function selectSupplier(Request $request){
        $supplier_id = $request->supplier;
        $select_supplier = Price::getProductPaginate()->where('supplier_id',$supplier_id)->get();
        $select_supplier->each(function ($dt) {
            getDiscount($dt);
        });
        return response()->json($select_supplier);
    }
}
