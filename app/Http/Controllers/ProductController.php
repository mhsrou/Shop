<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withoutTrashed()->paginate(10);
        return view('product.home')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $this->authorize('create', Product::class);

        $imageName = time() . '.' . $request->image->extension();


        if ($request->hasFile('image'))
            $path = Storage::putFileAs(
                'images', $request->file('image'), $imageName
            );

        //$request->image->move(public_path('images'), $imageName);

        $validated = $request->validated();

        $validated['image'] = $imageName;

        $newProduct = Product::create($validated);

        return redirect(route('admin.product.show', $newProduct->id))->with('create', 'Product created');
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
    public function edit(Product $product)
    {
        $this->authorize('create', $product);

        $product = Product::findOrFail($product->id);
        return view('admin.product.edit')->with('product', $product);
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
        $this->authorize('create', $product);

        if ($request->has('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

        } else {
            $imageName = $product->image;
        }

        $validated = $request->validated();

        $validated['image'] = $imageName;

        $updatedProduct = $product->update($validated);

        return redirect(route('admin.product.show', $updatedProduct))->with('update', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        Product::find($product->id)->delete();

        return back()->with('product', $product->id)
            ->with('delete', 'Product post deleted');
    }

    public function forceDelete($id)
    {
        $this->authorize('delete', $product);

        Product::withTrashed()->find($id)->forceDelete();

        return redirect()
            ->route('admin.product.index')->with('forceDelete', 'Product post deleted permanently');
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();

        return back()->with('product', 'Product post restored');
    }

    public function deletedProducts()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('admin.product.index')->with('products', $products);
    }
}
