<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Notifications\NewCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Cache::remember('categories', 5*60, function() {
            return Category::all();
        });

        return view('category.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        $this->authorize('show', $category);

        return view('category.details', ['category' => $category]);

    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('category.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $category = Category::create($request->all());

         /**
         * @var User
         */
        $user = Auth::user();
        $user->notify(new NewCategory($category));

        $this->authorize('store', $category);

        return redirect('/categories');
    }

    public function edit(Category $category)
    {
        $this->authorize('edit', Category::class);

        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', Category::class);

        $category->update($request->all());

        return redirect('/categories');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', Category::class);

        $category->delete();

        return redirect('/categories');
    }
}
