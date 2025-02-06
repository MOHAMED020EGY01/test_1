<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){
        $product = Product::with('category')->Active()->latest()->take(8)->get();
        return view('Home',[
            'product' => $product
        ]);
    }
}
