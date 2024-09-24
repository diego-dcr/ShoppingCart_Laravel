<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;


class ProductController extends Controller
{
    private $path = 'images/products/';

    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all();
        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $img = $request->file('img');
        $url = $this->path . $img->getClientOriginalName();
        Storage::disk('public')->put($url, file_get_contents($img));

        $product = new Product($request->all());
        $product->img = $url;
        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $url = $this->path . $img->getClientOriginalName();
            Storage::disk('public')->put($url, file_get_contents($img));
            $product->img = $url;
        }
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index');
    }

    public function search(Request $request) {
        $products = [];
        $search = $request->input('search');
        if(!empty($search)) {
            $searchTerm = '%' . $search . '%';
            $products = Product::where('name', 'LIKE', $searchTerm)->get();
        }
        return view('product.index', compact('products'));
    }
}
