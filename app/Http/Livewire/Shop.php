<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Shop extends Component
{
    public $category    = 'All';
    public $brand       = '';
    public $minPrice    = '';
    public $maxPrice    = '';

    // public $categories  = [];
    // public $brands      = [];

    // protected $queryString = [
    //     'category' => ['except' => ''],
    //     'brand'    => ['except' => ''],
    //     'minPrice' => ['except' => ''],
    //     'maxPrice' => ['except' => ''],
    // ];

    public function resetFilters()
    {
        $this->reset(['category', 'brand',]);
    }

    // public function resetFilters()
    // {
    //     $this->category = 'category';
    //     $this->brand = 'brand';
    //     $this->minPrice = 'minPrice';
    //     $this->maxPrice = 'maxPrice';
    // }


    public function mount()
    {
        // $mongoClient = DB::connection('mongodb')->getMongoClient();
        // $db = $mongoClient->selectDatabase(env('DB_DATABASE'));

        // $this->categories = collect($db->command(['distinct' => 'products', 'key' => 'category'])->toArray()[0]['values'])
        //     ->filter()
        //     ->values()
        //     ->toArray();

        // $this->brands = collect($db->command(['distinct' => 'products', 'key' => 'brand'])->toArray()[0]['values'])
        //     ->filter()
        //     ->values()
        //     ->toArray();
        // $this->category = request()->query('category', '');
    }

    public function addToCart($productId)
    {
        $userId = Auth::id();
        if (! $userId) {
            session()->flash('success', 'Please log in to add items to your cart.');
            return;
        }

        // Fetch-or-create the cart
        $cart = CartModel::firstOrCreate(
            ['User_ID' => $userId],
            ['CreatedAt' => now(), 'UpdatedAt' => now(), 'items' => []]
        );

        $items = $cart->items ?? [];

        // If already in cart, increment quantity
        foreach ($items as &$item) {
            if ($item['ProductID'] === (string) $productId) {
                $item['Quantity']++;
                $item['Total_Price'] = $item['Quantity'] * $item['Price'];

                $cart->items     = $items;
                $cart->UpdatedAt = now();
                $cart->save();

                session()->flash('success', 'Quantity updated in your cart!');
                return;
            }
        }

        // Otherwise, add as new line-item
        $product = Product::findOrFail($productId);
        $items[] = [
            'ItemID'       => (string) Str::uuid(),
            'ProductID'    => (string) $productId,
            'product_name' => $product->product_name,
            'img_url'      => $product->img_url,
            'Quantity'     => 1,
            'Price'        => $product->price,
            'Total_Price'  => $product->price,
        ];

        $cart->items     = $items;
        $cart->UpdatedAt = now();
        $cart->save();

        session()->flash('success', 'Product added to your cart!');
    }


    public function render()
    {
        $products = Product::query();

        if ($this->category !== 'All') {
            $products->where('category', $this->category);
        }

        if ($this->brand) {
            $products->where('brand', $this->brand);
        }

        if ($this->minPrice !== '') {
            $products->where('price', '>=', (float) $this->minPrice);
        }

        if ($this->maxPrice !== '') {
            $products->where('price', '<=', (float) $this->maxPrice);
        }
        

        

        Log::info('this.category: ' . $this->category);

        return view('livewire.shop', [
            'products' => $products->get(),
        ]);
    }
}
