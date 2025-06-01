<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::limit(4)->get();
        return view('index', compact('products'));
    }

    public function shop(Request $request)
    {
        $category = $request->query('category');

        $products = Product::when($category, function ($query, $category) {
            return $query->where('category', $category);
        })->get();

        return view('shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        if (! $product) {
            abort(404);
        }

        return view('product.show', compact('product'));
    }
}
