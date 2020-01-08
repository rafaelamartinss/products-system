<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewProduct;

class ProductController extends Controller
{

    public function index()
    {
        return view('product.index', ['products' => Product::all()]);
    }

    public function show(Product $product)
    {
        $this->authorize('show', Product::class);

        return view('product.details', ['product' => $product]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('product.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $this->authorize('store', Product::class);

        $request->validate([
            'name'=>'required',
            'value'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);

        $product = Product::create($request->all());

        /**
         * @var User
         */
        $user = Auth::user();
        $user->notify(new NewProduct($product));

        return redirect('/products')->with('success', 'Product saved!');
    }

    public function edit(Product $product)
    {
        $this->authorize('edit', Product::class);

        return view('product.edit', ['product' => $product, 'categories' => Category::all()]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', Product::class);

        $product->update($request->all());

        return redirect('/products')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', Product::class);

        $product->delete();

        return redirect('/products')->with('success', 'Product deleted!');
    }
}
