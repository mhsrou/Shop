<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withTrashed()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $imageName = $request->file('image')->getClientOriginalName();

        $validated['image'] = $imageName;

        $product = DB::transaction(function () use ($validated, $request, $imageName) {

            $product = auth()->user()->products()->create($validated);
            $product->user_id = Auth::user()->id;

            if (isset($validated['category_id']))
                $product->categories()->sync($validated['category_id']);


            Storage::putFileAs(
                'products',
                $request->file('image'),
                $imageName
            );


            $path = $request->file('image')->storePublicly('products');
            $product->images()->create([
                'url' => $path,
                'name' => $request->file('image')->getClientOriginalName(),
            ]);

            return $product;
        });

        foreach ($request->file('gallery') as $file) {
            $path = $file->storePublicly("products/gallery/$product->id");
            $product->images()->create([
                'url' => $path,
                'name' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()
            ->route('product.index')
            ->with('message', "Post $product->name Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
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
        $categories = Category::whereNotNull('parent_id')->get();
        return view('admin.product.edit', compact('product', 'categories'));
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
        $imageName = time() . '.' . $request->image->extension();

        if ($request->hasFile('image'))
            Storage::putFileAs(
                'images',
                $request->file('image'),
                $imageName
            );

        $validated = $request->validated();

        $validated['image'] = $imageName;

        $product->update($validated);

        return redirect(route('admin.product.index'))->with('update', 'Product updated successfully');
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

        return redirect()
            ->route('product.index')->with('delete', 'Product deleted');
    }

    public function forceDelete($id)
    {
        Product::withTrashed()->find($id)->forceDelete();

        return redirect()
            ->route('product.index')->with('forceDelete', 'Product deleted permanently');
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();

        return back()->with('product', 'Product restored');
    }
}
