<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SingleProduct extends Component
{
    public $product;

    public function mount($id)
    {
        
        $this->product = Product::findOrFail($id);
    }

    public function addToCart()
    {
        $userId = Auth::id();

        
        $cart = CartModel::firstOrCreate(
            ['User_ID' => $userId],
            ['CreatedAt' => now(), 'UpdatedAt' => now(), 'items' => []]
        );

        $items = $cart->items ?? [];

        
        foreach ($items as &$item) {
            if ($item['ProductID'] === (string)$this->product->_id) {
                $item['Quantity']++;
                $item['Total_Price'] = $item['Quantity'] * $item['Price'];

                $cart->items = $items;
                $cart->UpdatedAt = now();
                $cart->save();

                session()->flash('success', 'Quantity updated in your cart!');
                return;
            }
        }

        
        $items[] = [
            'ItemID' => (string) Str::uuid(),
            'ProductID' => (string) $this->product->_id,
            'product_name' => $this->product->product_name,
            'img_url' => $this->product->img_url,
            'Quantity' => 1,
            'Price' => $this->product->price,
            'Total_Price' => $this->product->price
        ];

        $cart->items = $items;
        $cart->UpdatedAt = now();
        $cart->save();

        session()->flash('success', 'Product added to your cart!');
    }


    public function render()
    {
        
        return view('livewire.single-product', [
            
            'product' => $this->product,
        ]);
    }
}
