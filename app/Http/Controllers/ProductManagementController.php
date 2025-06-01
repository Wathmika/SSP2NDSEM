<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index()
    {
        
        $products = Product::all();
        return view('productmanagement', compact('products'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'product_name'     => 'required|string',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'qty'              => 'required|integer',
            'brand'            => 'required|string',
            'category'         => 'required|string',
            'img_url'          => 'required|image',      
            'discount'         => 'nullable|integer',
        ]);

        
        $path = $request->file('img_url')->store('products', 's3_gcs');
        

        try {
            Product::create([
                'product_name'     => $request['product_name'],
                'description'      => $request['description'],
                'price'            => $request['price'],
                'discounted_price' => $request['discounted_price'],
                'qty'              => $request['qty'],
                'brand'            => $request['brand'],
                'category'         => $request['category'],
                'img_url'          => $path, 
                'discount'         => $request['discount'] ?? null, 
            ]);
            return redirect()->route('product.management')
                ->with('message', 'Product added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('product.management')
                ->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'id'               => 'required|string|exists:products,id',
            'product_name'     => 'nullable|string',
            'description'      => 'nullable|string',
            'price'            => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'qty'              => 'nullable|integer',
            'brand'            => 'nullable|string',
            'category'         => 'nullable|string',
            'img_url'          => 'nullable|image',
        ]);

        
        $product = Product::find($request->id);

        
        $update = $request->only([
            'product_name',
            'description',
            'price',
            'discounted_price',
            'qty',
            'brand',
            'category',
            'img_url',
            'discount',
        ]);

        
        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('products', 's3_gcs');
            $product->img_url = $path; 
            $product->save(); 
        }

        
        $product->update(array_filter($update));

        return redirect()->route('product.management')
            ->with('message', 'Product updated successfully!');
    }

    public function destroy(Request $request)
    {
        
        $request->validate([
            'id' => 'required|string|exists:products,id',
        ]);

        
        Product::destroy($request->id);

        return redirect()->route('product.management')
            ->with('message', 'Product removed successfully!');
    }
}
