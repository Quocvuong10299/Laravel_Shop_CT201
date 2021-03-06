<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Category_gender;
use App\Color;
use App\Comment;
use App\Date_sale;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use App\Percent_sale;
use App\Price;
use App\Product;
use App\Product_attribute;
use App\Size;
use App\Slide;
use App\Supplier;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Response;
use DB;
use Storage;
use App\Helper\Date;
use Carbon\Carbon;
use function App\Helper\Helper\toSlug;
class apiController extends Controller
{
//    public function user_index(){
//        return view('admin.admin');
//    }
    public function getUser(){
        $user =  User::orderBy('user_id','desc')->where('user_role',0)->paginate(6);
        return response()->json($user);
    }
    public function getUserToDay(){
        $current_day = date('Y-m-d');
        $member_today = DB::table('users')->where('user_register_date',$current_day)->get();
        return response()->json($member_today);
    }
    public function removeUser($id){
        $delUser = User::find($id);
        $delUser->delete();
        return response()->json(['message'=>'delete success']);
    }
    public function logOutAdmin(){
        Auth::logout();
        Session::flush();
//        return redirect()->route('getAdminLogin');
        return response()->json(['message'=>'logout success']);
    }
//    category
    public function getCategory(){
        $category =  Category::where('parent_id','>',0)->orderBy('category_id','DESC')->paginate(6);
        $category_parent =  Category::where('parent_id',0)->get();
//        return response()->json($category);
        return Response::json(array(
            'category' => $category,
            'category_parent' => $category_parent,
        ));
    }
    public function addCategory(Request $request){
        $add_cat = new Category;
        $add_cat->category_name = $request->get('name');
        $add_cat->category_slug = toSlug($request->get('name'));
        $add_cat->parent_id = $request->get('items');
        $add_cat->category_gender_id = $request->get('gender');
        $add_cat->category_show = $request->get('show');
        $add_cat->save();
        return $add_cat;
    }
    public function editCategory(Request $request, $id){
        $edit_cat = Category::where('category_id', $id)->first();
        $edit_cat->category_name = $request->get('val_1');
        $edit_cat->category_slug = toSlug($request->get('val_1'));
        $edit_cat->parent_id = $request->get('val_2');
        $edit_cat->category_gender_id = $request->get('val_3');
        $edit_cat->category_show = $request->get('val_4');
        $edit_cat->save();
        return $edit_cat;
    }

//    products
    public function getProduct(){
        $products = DB::table('products')
            ->join('category','products.category_id','=','category.category_id')
            ->join('category_gender','products.category_gender_id','=','category_gender.category_gender_id')
            ->join('supplier','products.supplier_id','=','supplier.supplier_id')
            ->select([
                'category.category_name',
                'products.product_id',
                'products.product_name',
                'products.product_active',
                'products.product_image',
                'products.product_description',
                'products.product_active',
                'products.product_new',
                'products.product_show',
                'category.category_id',
                'category_gender.category_gender_id',
                'category_gender.category_gender_name',
                'supplier.supplier_name',
                'supplier.supplier_id',
            ])
            ->orderBy('product_id','DESC')
            ->paginate(6);
        $product_category = Category::where('parent_id','>',0)->get();
        $product_supplier = Supplier::all();
        $product_gender = Category_gender::all();
        return Response::json(array(
            'products' => $products,
            'category' => $product_category,
            'supplier' => $product_supplier,
            'gender' => $product_gender,
        ));
    }
    public function getDetailProduct($id){
        $product_detail = DB::table('products')
            ->join('category','products.category_id','=','category.category_id')
            ->join('category_gender','products.category_gender_id','=','category_gender.category_gender_id')
            ->join('supplier','products.supplier_id','=','supplier.supplier_id')
            ->select([
                'category.category_name',
                'products.product_id',
                'products.product_name',
                'products.product_active',
                'products.product_image',
                'products.product_description',
                'products.created_at',
                'products.product_active',
                'products.product_new',
                'products.product_show',
                'category.category_id',
                'category_gender.category_gender_id',
                'category_gender.category_gender_name',
                'supplier.supplier_name',
                'supplier.supplier_id',
            ])
            ->orderBy('product_id','DESC')
            ->where('products.product_id', $id)
            ->get();
        return response()->json($product_detail);
    }
    public function getDateSale(){
        $date_sale = Date_sale::all();
        return response()->json($date_sale);
    }
    public function getPercentSale(){
        $percent_sale = Percent_sale::all();
        return response()->json($percent_sale);
    }
    public function addProduct(Request $request){
        $image_pro = $request->get('pro_image');
        $add_pro = new Product;
        $add_pro->product_name = $request->get('name');
        $add_pro->product_slug = toSlug($request->get('name'));
        $add_pro->category_id = $request->get('category');
        $add_pro->category_gender_id = $request->get('gender');
        $add_pro->supplier_id = $request->get('supplier');
        $add_pro->product_description = $request->get('description');
        $add_pro->product_active = $request->get('active');
        $add_pro->product_new = $request->get('pro_new');
        $add_pro->product_show = $request->get('show');
//        $add_pro->product_image= $request->get('pro_image');
        $add_pro->product_image = $this->saveImgBase64($image_pro, 'uploads');
        $add_pro->save();
//        return $add_pro;

//        $pro_price = new Price;
//        $pro_price->date_id = $request->get('date_sale');
//        $pro_price->percent_value = $request->get('percent_discount');
//        $pro_price->product_id = $add_pro->product_id;
//        $pro_price->unit_price =  $request->get('pro_price');
//        $pro_price->save();
//        return response()->json(['success' => 'success']);
    }
    public function editProduct(Request $request,$id){
        $edit_pro = Product::where('product_id', $id)->first();
        $edit_pro->category_id = $request->get('val_pro_2');
        $edit_pro->category_gender_id = $request->get('val_pro_3');
        $edit_pro->supplier_id = $request->get('val_pro_7');
        $edit_pro->product_name = $request->get('val_pro_1');
        $edit_pro->product_slug = toSlug($request->get('val_pro_1'));
//        $edit_pro->product_image = $request->get('val_4');
//        $edit_pro->product_description = $request->get('val_4');
        $edit_pro->product_active = $request->get('val_pro_5');
        $edit_pro->product_new = $request->get('val_pro_6');
        $edit_pro->product_show = $request->get('val_pro_4');
        $edit_pro->save();
        return $edit_pro;
    }
    public function getProductAttribute(){
        $attr = DB::table('product_attribute')
            ->join('products','product_attribute.product_id','=','products.product_id')
            ->join('colors','product_attribute.color_value','=','colors.color_value')
            ->select([
                'products.product_name',
                'product_attribute.*',
                'colors.color_name',
            ])
            ->paginate(6);
        return response()->json($attr);
    }
//product attribute
    public function getProAttr(){
        $pro_attr = Product::all(['product_id','product_name']);
        return response()->json($pro_attr);

    }
    public function postProAttr(Request $request){
        $attr = new Product_attribute;
        $attr->size_value = $request->get('size');
        $attr->color_value = $request->get('color');
        $attr->product_id = $request->get('pro_id');
        $attr->quantity_current = $request->get('qty');
        $attr->sku = $request->get('sku');
        $attr->coupon_id = $request->get('coupon');
        $attr->save();
        return response()->json(['message'=>'create success']);
    }
    public  function removeAttr($sku){
        $delAttr = Product_attribute::where('sku',$sku)->first();
        $delAttr->delete();
        return response()->json(['message'=>'delete success']);
//        $delAtrr = DB::table('product_attribute')->where('sku',$sku)->delete();
//        return $delAtrr;
    }
//    public function editAttr(Request $request,$pro_id){
//        $edit_attr = Product_attribute::where('product_id', $pro_id)->first();
//        $edit_attr->sku = $request->get('attr_1');
//        $edit_attr->quantity_current = $request->get('attr_2');
//        $edit_attr->product_id = $request->get('attr_3');
//        $edit_attr->size_value = $request->get('attr_4');
//        $edit_attr->color_value = $request->get('attr_5');
//        $edit_attr->save();
//        return $edit_attr;
//    }
//price
    public function getPrice(){
        $prices = DB::table('prices')
            ->join('date_sale','prices.date_id','=','date_sale.date_id')
            ->join('products','prices.product_id','=','products.product_id')
            ->join('percent_sale','prices.percent_value','=','percent_sale.percent_value')
            ->select([
                'date_sale.*',
                'percent_sale.*',
                'prices.*',
                'products.product_id',
                'products.product_name',
            ])
            ->orderBy('unit_price','ASC')
            ->paginate(5);
        return response()->json($prices);
    }
    public function getProPrice(){
        $productPrice = Product::all(['product_id','product_name']);
        return response()->json($productPrice);
    }
    public function getPercent(){
        $percent = Percent_sale::all();
        return response()->json($percent);
    }
    public function getDateId(){
        $dateId = Date_sale::all();
        return response()->json($dateId);
    }
    public function addPrice(Request $request){
        $price = new Price;
        $price->date_id = $request->get('date');
        $price->percent_value = $request->get('percent_sale');
        $price->product_id = $request->get('productID');
        $price->unit_price = $request->get('unitPrice');
        $price->promotion_price = $request->get('promotionPrice');
        $price->save();
        return response()->json(['message'=>'create success']);
    }
    public function editPrice(Request $request,$id){
//        $edit_price = Price::findOrFail($id);
        $edit_price = DB::table('prices')->where('product_id',$id)->update([
            'date_id' => $request->get('price_2'),
            'percent_value' => $request->get('price_1'),
            'product_id' => $request->get('price_4'),
            'unit_price' =>$request->get('price_3')
        ]);
        return $edit_price;
    }
//    day sale
    public function getDay(){
        $day = Date_sale::all();
        return response()->json($day);
    }
    public function updateDay(Request $request, $id){
        $edit_day = Date_sale::where('date_id', $id)->first();
        $edit_day->date_start = $request->get('day_1');
        $edit_day->date_end = $request->get('day_2');
        $edit_day->save();
        return $edit_day;
    }
    public function postDay(Request $request){
        $day = new Date_sale;
        $day->date_id = $request->get('day_id');
        $day->date_start = $request->get('start');
        $day->date_end = $request->get('end');
        $day->save();
        return response()->json(['message'=>'create success']);
}
//    comments
    public function getComment(){
        $comments = DB::table('comments')
            ->join('users','comments.user_id','=','users.user_id')
            ->join('products','comments.product_id','=','products.product_id')
            ->select([
                'users.user_name',
                'products.product_name',
                'products.product_id',
                'comments.comment_content',
                'comments.comment_id',
                'comments.created_at',
            ])
            ->orderBy('created_at','DESC')
            ->paginate(5);
        return response()->json($comments);

    }
    public function removeComment($id){
        $delCmt = Comment::find($id);
        $delCmt->delete();
        return response()->json(['message'=>'delete success']);
    }
//    slides
    public function getSlide(){
        $slides = Slide::orderBy('slide_id','DESC')->paginate(2);
        return response()->json($slides);
    }
    public function editSlides(Request $request, $id){
        $edit_slide = Slide::where('slide_id', $id)->first();
        $edit_slide->slide_show = $request->get('val_show');
        $edit_slide->save();
        return $edit_slide;
    }
    public function addSlides(Request $request){
        $image = $request->get('image');

        $image_slide = new Slide;
        $image_slide->slide_link = $this->saveImgBase64($image, 'uploads');
        $image_slide->save();
        return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }
    protected function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $fileName;
    }

//    color
    public function getColor(){
        $colors = DB::table('colors')->get();
        return response()->json($colors);
    }
    public function addColor(Request $request){
        $color = new Color;
        $color->color_value = $request->get('color');
        $color->color_name = $request->get('color_name');
        $color->save();
        return response()->json(['message'=>'create success']);
    }
//    size
    public function getSize(){
        $size = DB::table('sizes')->get();
        return response()->json($size);
    }
    public function addSize(Request $request){
        $add_size = new Size;
        $add_size->size_value = $request->get('size');
        $add_size->save();
        return response()->json(['message'=>'create success']);
    }
//    supplier
    public function getSupplier(){
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
    public function postSupplier(Request $request){
        $supp = new Supplier;
        $supp->supplier_name = $request->get('name_supplier');
        $supp->save();
        return response()->json(['message'=>'created success']);
    }
//    order
    public function getAllOrder(){
        $all_order = Order::orderBy('order_date','DESC')->paginate(20);
        return response()->json($all_order);
    }
    public function getDetailOrder($id){
        $order_detail = DB::table('order_detail')
            ->join('orders','order_detail.order_id','=','orders.order_id')
            ->join('products','order_detail.product_id','=','products.product_id')
            ->select([
                'orders.*',
                'order_detail.*'
            ])
            ->where('orders.order_id',$id)
            ->get();
        return response()->json($order_detail);
    }
    public function stateStatus(Request $request,$id){
        $new_state = Order::findOrFail($id);
        $new_state->order_state = $request->get('val_state');
        $new_state->save();
    }
    public function getOrderToday(){
        $current_day = date('Y-m-d');
        $bill_today = DB::table('orders')->whereDate('order_date',$current_day)->get();
        return response()->json($bill_today);
    }
    public function getNumberOrder(){
        $count_length = DB::table('orders')->where('order_state',0)->get();
        return response()->json($count_length);
    }
    public function getListDay(){
        $listDay = Date::getListDayInMonth();
        return response()->json($listDay);
    }
    public function getPrice_Filter_onday(Request $request){
//        $start_date = '2020-07-01';
//        $end_date = '2020-07-20';
//        $start = Carbon::parse($start_date);
//        $end = Carbon::parse($end_date);
//        $filter_order = Order::where('order_current_day','<=',$end)
//            ->where('order_current_day','>=',$start)
//            ->get(['order_total','order_current_day']);
//        $sum = 0;
//        foreach ($filter_order as $key=>$value){
//            $sum += $value->order_total;
//        }
//        return response()->json($filter_order);
        $today = Carbon::now();
        $day_filter = Carbon::parse($today);
        $get_filter_day = Order::whereDate('order_date',$day_filter)->get(['order_total']);
        $sum = 0;
        foreach ($get_filter_day as $key=>$value){
            $sum += $value->order_total;
        }
        return response()->json($sum);
    }
    public function post_revenue_one_day(Request $request){

    }
}
