<?php
namespace App\Http\Controllers;
use function App\Helper\Helper\getDiscount;
use App\Product_attribute;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Product;
use App\Comment;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $data = DB::table('prices')
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
            ])
            ->take(8)
            ->orderBy('prices.product_id','DESC')
            ->get();
//        get product sale
        $data_sale = DB::table('prices')
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
            ])
            ->take(8)
            ->where('date_sale.date_start','<>',null)
            ->Where('date_sale.date_end','<>',null)
            ->get();
        $data->each(function ($dt) {
            getDiscount($dt);
        });
        $data_sale->each(function ($dt){
            getDiscount($dt);
        });
        return view('pages.home', compact('data','data_sale'));
    }
    public function productDetail($id){
//        Carbon::setLocale('vi');
////        $comment = Comment::where('product_id',$id)->orderBy('created_at','DESC')->paginate(3);
        $product_detail = Product::where('product_id', $id)->get();
//        $attr = DB::table('product_attribute')
//            ->join('products', 'product_attribute.product_id', '=', 'products.product_id')
//            ->join('colors', 'product_attribute.color_value', '=', 'colors.color_value')
//            ->join('sizes', 'product_attribute.size_value', '=', 'sizes.size_value')
//            ->select
//            ([
//                'product_attribute.sku',
//                'colors.color_value',
//                'colors.color_name',
//                'sizes.size_value',
//                'product_attribute.quantity_current',
//            ])
//            ->where('products.product_id',$id)
//            ->where('colors.color_value','#000')
//            ->get();
//        dd($attr);
        $attribute = DB::table('product_attribute')->where('product_id',$id)->get();
        $collection = collect($attribute);
        $uniqueColor = $collection->unique('color_value');
        $uniqueSize = $collection->unique('size_value');
        $uniqueColor->values()->all();
        $uniqueSize->values()->all();
//        $uniqueColor = $attr->unique('color_value');
//        $uniqueSize = $attr->unique('size_value');
//        $uniqueColor->values()->all();
//        $uniqueSize->values()->all();
//        $attr = json_decode(json_encode($attr));
//        $uniqueColor = json_decode(json_encode($uniqueColor));
//        $uniqueSize = json_decode(json_encode($uniqueSize));
        return view('pages.detail',compact('uniqueColor','uniqueSize','product_detail'));
    }

    public function selectColor(Request $request){
        $color_value = $request->color;
        $id = $request->id;
        $attribute = DB::table('product_attribute')
            ->join('products', 'product_attribute.product_id', '=', 'products.product_id')
            ->join('colors', 'product_attribute.color_value', '=', 'colors.color_value')
//            ->select
//            ([
//                'product_attribute.sku',
//                'product_attribute.quantity_current',
//                'colors.color_value',
//                'sizes.size_value',
//            ])
            ->where('products.product_id',$id)
            ->where('colors.color_value',$color_value)
            ->get();
        return response()->json($attribute);
    }
    public function selectSize(Request $request){
        $size_value = $request->size;
        $color_value = $request->color;
        $id = $request->id;
        $attribute = DB::table('product_attribute')
            ->join('products', 'product_attribute.product_id', '=', 'products.product_id')
            ->join('colors', 'product_attribute.color_value', '=', 'colors.color_value')
            ->join('sizes', 'product_attribute.size_value', '=', 'sizes.size_value')
            ->select
            ([
                'product_attribute.sku',
                'sizes.size_value',
                'product_attribute.quantity_current',
            ])
            ->where('products.product_id',$id)
            ->where('colors.color_value',$color_value)
            ->where('sizes.size_value',$size_value)
            ->get();
        return response()->json($attribute);
    }
}
