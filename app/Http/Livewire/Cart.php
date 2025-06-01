<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Cart extends Component
{
    public $cart;
    public $cartItems = [];

    public function mount()
    {
        $userId = Auth::id();

        $this->cart = CartModel::firstOrCreate(
            ['User_ID' => $userId],
            ['CreatedAt' => now(), 'UpdatedAt' => now(), 'items' => []]
        );

        $this->cartItems = $this->cart->items;
    }

    public function incrementQuantity($itemId)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['ItemID'] === $itemId) {
                $item['Quantity']++;
                $item['Total_Price'] = $item['Quantity'] * $item['Price'];
            }
        }
        $this->updateCart();
    }

    public function decrementQuantity($itemId)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['ItemID'] === $itemId && $item['Quantity'] > 1) {
                $item['Quantity']--;
                $item['Total_Price'] = $item['Quantity'] * $item['Price'];
            }
        }
        $this->updateCart();
    }

    public function removeItem($itemId)
    {
        $this->cartItems = array_filter($this->cartItems, function ($item) use ($itemId) {
            return $item['ItemID'] !== $itemId;
        });
        $this->updateCart();
    }

    // ✅ ADD THIS METHOD HERE:
    public function addItemToCart($product, $quantity = 1)
    {
        $newItem = [
            'ItemID' => (string) Str::uuid(),
            'ProductID' => (string) $product->_id,
            'product_name' => $product->product_name,
            'img_url' => $product->img_url,
            'Quantity' => $quantity,
            'Price' => $product->price,
            'Total_Price' => $product->price * $quantity,
        ];

        $this->cartItems[] = $newItem;
        $this->updateCart();
    }

    private function updateCart()
    {
        $this->cart->items = array_values($this->cartItems);
        $this->cart->UpdatedAt = now();
        $this->cart->save();
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
