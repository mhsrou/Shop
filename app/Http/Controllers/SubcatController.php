<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SubcatController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke($id)
    {
        $products = Product::where('category_id', $id)->paginate(12);
        $incredibleProducts = Product::where('category_id', $id)->where('is_incredible', 1)->withoutTrashed()->get();
        return view('product.home', compact('products', 'incredibleProducts'));
    }

}
