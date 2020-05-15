<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function getAdminLogin(){
        return view('admin.login_admin');
    }
    public function postAdminLogin(Request $request){
//        $this->validate($request,[
//            'user_email'=>'required',
//            'password'=>'required',
//        ],[
//            'user_email.required'=> 'Email không được để trống ',
//            'p.required'=> 'Password không được để trống '
//        ]);
        if(Auth::attempt(['user_email'=>$request->admin_email, 'password'=>$request->admin_password,'user_role'=>1])){
            return redirect()->route('getDashboard');
        }else{
            return redirect()->route('getAdminLogin');
        }
    }
    public function getDashboard(){
        return view('admin.admin');
    }
}
