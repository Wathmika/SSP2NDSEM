<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class Checkout extends Component
{
    public $cartItems = [];

    
    public $name, $email, $address, $postal_code, $phone;

    
    public $card_name, $card_number, $expiration, $cvv;

    public function mount()
    {
        $userId = Auth::id();
        $cart      = CartModel::firstWhere('User_ID', $userId);
        $this->cartItems = $cart->items ?? [];
    }

    protected function rules()
    {
        return [
            
            'name'        => 'required|string',
            'email'       => 'required|email',
            'address'     => 'required|string',
            'postal_code' => 'required|string',
            'phone'       => 'required|string',
            'card_name'   => 'required|string',
            'card_number' => 'required|digits_between:12,19',
            'expiration'  => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv'         => 'required|digits:3',
        ];
    }

    public function processPayment()
    {
        $this->validate();

        
        $subtotal = array_sum(array_column($this->cartItems, 'Total_Price'));
        $delivery = 99;
        $tax      = 0.10 * $subtotal;
        $total    = $subtotal + $delivery + $tax;


        
        Order::create([
            'User_ID'         => Auth::id(),
            'CartID'          => (string) CartModel::firstWhere('User_ID', Auth::id())->_id,
            'items'           => $this->cartItems,
            'TotalAmount'     => $total,
            'Status'          => 'pending',
            'ShippingAddress' => $this->address,
            'OrderDate'       => now(),
            'Delivery_Fee'    => $delivery,
        ]);

        
        foreach ($this->cartItems as $item) {
            
            $product = Product::where('_id', $item['ProductID'])->first();

            if ($product) {
                
                $newQty = max(0, $product->qty - $item['Quantity']);
                $product->qty = $newQty;
                $product->save();
            }
        }

        session()->flash('success', 'Payment processed & order placed!');

        
        CartModel::firstWhere('User_ID', Auth::id())->update(['items' => []]);
        $this->cartItems = [];
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
