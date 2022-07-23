<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        return view('index');
    }

    public function test() {
        $product = Product::with(['brand', 'category', 'attrs'])->find(1)->toArray();
        //$category = Category::with(['attrs'])->find(2)->toArray();
        echo '<pre>';
        var_dump($product);
        echo '</pre>';
        //return "<pre>". $product . "</pre>";
    }
}
