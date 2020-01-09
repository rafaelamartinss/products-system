<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Notifications\NewProduct;

class ProductController extends Controller
{

    public function index()
    {
        $products = Cache::remember('products', 5*60, function() {
            return Product::all();
        });

        return view('product.index', ['products' => $products]);
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

        return redirect('/products');
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

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', Product::class);

        $product->delete();

        return redirect('/products');
    }
}
