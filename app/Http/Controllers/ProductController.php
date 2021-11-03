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
//        if (!auth->user()->hasRole([super_admin, admin]))
//            $products = auth()->user()->products()->withTrashed()->paginate(10);
//        else
            $products = Product::withTrashed()->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $requestImages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = DB::transaction(function () use ($request) {
            $product = auth()->user()->products()->create($request->all());

            if (isset($validated['user_id']))
                $product->user_id = auth()->user()->id;

            if (isset($validated['category_id']))
                $product->categories()->sync($validated['category_id']);

            $path = $request->file('image')->storePublicly('products');
            $product->images()->create([
                'url' => $path,
                'name' => $request->file('image')->getClientOriginalName(),
            ]);

            foreach ($request->file('gallery') as $file) {
                $path = $file->storePublicly("products/gallery/$product->id");
                $product->images()->create([
                    'url' => $path,
                    'name' => $file->getClientOriginalName(),
                ]);
            }

            return $product;
        });

        return redirect()
            ->route('product.index')
            ->with('message', "Product $product->title Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
