<?php
namespace App\Http\Controllers;
use function App\Helper\Helper\getDiscount;
use function App\Helper\Helper\toSlug;
use App\Payment;
use App\Slide;
use Auth;
use App\Product;
use Storage;
use App\Order;
use App\Order_detail;
use App\Price;
//use App\Product_attribute;
use function foo\func;
use Illuminate\Http\Request;
//use Illuminate\Support\Collection;
//use App\Product;
use App\Comment;
use App\Category_gender;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
//    show index page
    public function index()
    {
//        get category gender
            $gender = Category_gender::all(['category_gender_id','category_gender_name']);
            $data = Price::getProduct()->take(8)->sortByDesc('product_id');
            $data->each(function ($dt) {
                getDiscount($dt);
            });
//        get product sale and calc days in order to discount
            $data_sale = Price::getProduct()->take(8)->where('date_start','<>',null)->Where('date_end','<>',null);
            $data_sale->each(function ($dt){
                getDiscount($dt);
            });
//            get slide
            $slides = Slide::where('slide_show',1)->get();
            return view('pages.home', compact('data','data_sale','gender','slides'));
    }
//    get API comments
    public function getComment($id){
        $cmt = DB::table('comments')
            ->join('users','comments.user_id','=','users.user_id')
            ->join('products','comments.product_id','products.product_id')
            ->select([
                'comments.comment_content',
                'products.product_id',
                'users.user_name',
                'comments.created_at'
            ])
            ->where('products.product_id', $id)
            ->orderBy('comments.created_at','DESC')
            ->get();
        return response()->json($cmt);
    }
//  Post API comments
    public function postComment(Request $request){
        $id = $request->route('id');
        $cmt = new Comment;
        $cmt->comment_content = $request->comment;
        $cmt->user_id = Auth::user()->user_id;
        $cmt->product_id = $id;
//        dd($cmt);
        $cmt->save();
        return redirect()->route('productDetail',$id);
//        return response()
    }
//    show product detail
    public function productDetail($id){
//        Carbon::setLocale('vi');
//        $product_detail = Product::where('product_id', $id)->cursor();
        $attribute = DB::table('product_attribute')->where('product_id',$id)->get();
        $price_detail = Price::getProduct()->where('product_id',$id);
        $price_detail->each(function ($dt) {
            getDiscount($dt);
        });
        $collection = collect($attribute);
        $uniqueColor = $collection->unique('color_value');
        $uniqueSize = $collection->unique('size_value');
        $uniqueColor->values()->all();
        $uniqueSize->values()->all();
        return view('pages.detail',compact('uniqueColor','uniqueSize','price_detail'));
    }
    public function getTimePost(){
        Carbon::setLocale('vi');
//        $commentPost = Comment::
    }
//    API color option
    public function selectColor(Request $request){
        $color_value = $request->color;
        $id = $request->id;
        $attribute = DB::table('product_attribute')
            ->join('products', 'product_attribute.product_id', '=', 'products.product_id')
            ->join('colors', 'product_attribute.color_value', '=', 'colors.color_value')
            ->where('products.product_id',$id)
            ->where('colors.color_value',$color_value)
            ->get();
        return response()->json($attribute);
    }
//    API color and size option
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
                'colors.color_name',
                'product_attribute.quantity_current',
            ])
            ->where('products.product_id',$id)
            ->where('colors.color_value',$color_value)
            ->where('sizes.size_value',$size_value)
            ->get();
        return response()->json($attribute);
    }
//    show cart
    public function showCart(){
        return view('pages.cart');
    }
//    show checkouts
    public function checkOuts(){
//        $ok = $request ->cart;
//        var_dump($ok);
        $payment = Payment::all();
        return view('pages.checkout', compact('payment'));
    }
//    API search
    public function searchIndex(Request $request){
        $seach_value = $request->value;

        $products = DB::table('products')->where('product_name', 'like', '%' .$seach_value. '%')->get();
        return response()->json($products);
    }
//oder request
    public function postCheckOuts(Request $request){
        $order = new Order;
        $order->order_address =  $request->order_address;
        $order->order_phone =  $request->order_phone;
        $order->order_note =  $request->order_note;
        $order->order_total =  $request->order_total;
        $order->payment_id =  $request->order_payment;
//        $order->save();

//       $detail = new Order_detail;
//       $detail->order_id = $order->order_id;
//       $detail->order_detail_id = random_int(99);
//       $detail->product_id = $request->get('proid');
//       $detail->product_id = $request->get('proname');
//       $detail->order_detail_price = $request->get('proprice');
////       $detail->product_id = $request->get('sku');
//       $detail->order_detail_size = $request->get('size');
//       $detail->order_detail_color = $request->get('color');
//       $detail->order_detail_quantity = $request->get('qty');
//       $detail->save();
//       return $detail;

        $cart = $request->get('cart');
//        dd($cart);
//        foreach ($cart as $key => $value){
//            $detail = new Order_detail;
//            $detail->order_id = $order->order_id;
////            foreach()
//            $detail->order_detail_id = random_int(999);
//            $detail->product_id = $value['prodID'];
//            $detail->save();
////            dd($value);
//        }
    }

}