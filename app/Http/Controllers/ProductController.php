<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:product-list|product-create|product-edit|product-delete', only : ['index','store']),
            new Middleware('permission:product-create', only : ['create','store']),
            new Middleware('permission:product-edit', only : ['edit','update']),
            new Middleware('permission:product-delete', only : ['destroy']),
        ];
    }

    public function index(): View
    {
        $products = Product::latest()->paginate(5);

        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'price' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function search()
    {
        $products = Product::all();
        return view('products.list_product', compact('products'));
    }
}
