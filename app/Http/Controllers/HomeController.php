<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withoutTrashed()->allAvailableProducts()->paginate(12);
        $incredibleProducts = Product::withoutTrashed()->incredibleProducts()->get();
        return view('product.home', compact('products','incredibleProducts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::withoutTrashed()->where('category_id', $product->category_id)->get();
        return view('product.show', compact('product','relatedProducts'));
    }

    public function showAll()
    {
        $products = Product::withoutTrashed()->paginate(12);
        return view('product.query', compact('products'));
    }

    public function showIncredible()
    {
        $products = Product::withoutTrashed()->allAvailableProducts()->incredibleProducts()->paginate(12);
        return view('product.query', compact('products'));
    }

    public function showSoon()
    {
        $products = Product::withoutTrashed()->soonProducts()->paginate(12);
        return view('product.query', compact('products'));
    }

    public function showRunningOut()
    {
        $products = Product::withoutTrashed()->runningOutProducts()->paginate(12);
        return view('product.query', compact('products'));
    }

}
