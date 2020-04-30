<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Category_gender;
use App\Color;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use App\Slide;
use App\Supplier;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Response;
use DB;
use Storage;
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
    public function removeUser($id){
        $delUser = User::find($id);
        $delUser->delete();
        return response()->json(['message'=>'delete success']);
    }
    public function logOutAdmin(){
        Auth::logout();
        return redirect()->route('getAdminLogin');
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
}
