<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $products = Product::where('category_id', $id)->get();
        $incredibleProducts = Product::where('category_id', $id)->where('is_incredible', 1)->withoutTrashed()->get();
        return view('product.home', compact('products','incredibleProducts'));
    }
    
}
