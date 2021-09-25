<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withoutTrashed()->get(); //fetch all blog posts from DB
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $validated = $request->validated();

        $validated['image'] = $imageName;

        $newProduct = Product::create($validated);

        return redirect(route('product.show', $newProduct->id))->with('create', 'Product created');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($request->has('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

        } else {
            $imageName = $product->image;
        }

        $validated = $request->validated();

        $validated['image'] = $imageName;

        $updatedProduct = $product->update($validated);

        return redirect(route('product.show', $product->id))->with('create', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        Product::find($product->id)->delete();

        return back()->with('product', $product)
            ->with('delete', 'Product post deleted');
    }

    public function forceDelete($id)
    {
        Product::withTrashed()->find($id)->forceDelete();

        return redirect()
            ->route('product.index')->with('forceDelete', 'Product post deleted permanently');
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();

        return back()->with('product', 'Product post restored');
    }
}
