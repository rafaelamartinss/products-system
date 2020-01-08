<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications\NewProductSlack;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::all();

        return view('product.index', ['products' => $products]);

    }

    public function show($id)
    {
        $this->authorize('isAdmin', Product::class);

        return view('product.details', ['product' => Product::findOrFail($id)]);

    }

    public function create()
    {

        $this->authorize('isAdmin', Product::class);

        $categories = Category::all();

        return view('product.create', ['categories' => $categories]);

    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin', Product::class);

        $request->validate([
            'name'=>'required',
            'value'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);

        $category = Category::findOrFail($request->get('category_id'));

        $product = new Product([
            'name' => $request->get('name'),
            'value' => $request->get('value'),
            'quantity' => $request->get('quantity')
        ]);

        $category->products()->save($product);
        $product->notify(new NewProductSlack());

        return redirect('/products')->with('success', 'Product saved!');
    }

    public function edit($id)
    {
        $this->authorize('isAdmin', Product::class);

        $categories = Category::all();
        $product = Product::findOrFail($id);

        return view('product.edit', ['product' => $product, 'categories' => $categories]);

    }

    public function update(Request $request, $id)
    {

        $this->authorize('isAdmin', Product::class);

        $product = Product::findOrFail($id);
        $product->name = $request->get('name');

        $product->save();

        return redirect('/products')->with('success', 'Product updated!');

    }

    public function destroy($id)
    {

        $this->authorize('isAdmin', Product::class);

        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted!');

    }
}
