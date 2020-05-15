<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class accountController extends Controller
{
    public function getRegister(){
        return view('pages.register');
    }
    public function getLogin(){
        return view('pages.login');
    }
    public function postRegister(Request $request){
        $user = new User;
        $user->user_name = $request->name;
        $user->user_email = $request->email;
        $user->user_phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->user_register_date = date('Y-m-d');
        $user->save();
        return redirect('account/login')->with('mess_register','Đăng kí thành công hãy đăng nhập');
    }
    public function postLogin(Request $request){
        if(Auth::attempt(['user_email'=>$request->login_email, 'password'=>$request->login_password,'user_role'=>0])){
            return redirect()->route('home');
        }else{
            return redirect('account/login')->with('mess_login','Email hoặc Mật khẩu không đúng');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
