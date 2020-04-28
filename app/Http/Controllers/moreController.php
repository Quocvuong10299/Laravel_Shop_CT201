<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class moreController extends Controller
{
    public function contactUS(){
        return view('pages.contact');
    }
}
