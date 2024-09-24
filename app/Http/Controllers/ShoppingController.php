<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [];
        $products = Product::all();
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'src' => 'data:image/jpeg;base64,' . base64_encode($product->getImage()),
            ];
        }

        $product = Product::find($id);

        return view('product.show', compact('product', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(string $categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        $categories = ProductCategory::all();
        return view('product.index', compact('products', 'categories'));
    }
}
