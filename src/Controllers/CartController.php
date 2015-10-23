<?php

namespace Laravel\Shop\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller {

    public function lists() {


        return view('shop::cart');
    }

}
