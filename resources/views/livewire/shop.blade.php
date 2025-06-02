
    <div class="container mx-2 px-4 py-8">
      

      <h1 class="text-2xl font-bold mb-6 px-4">
          {{ $category ? Str::headline($category) : 'All' }} Products
      </h1>
    
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          
              
              <aside class="md:col-span-1 space-y-8">
                <div>
                <h3 class="font-semibold mb-2">Category</h3>
                <select wire:model.live="category" class="w-full border rounded p-2">
                  <option value="All">All Categories</option>
                  <option value="Premium">Premium</option>
                  <option value="MainLine">MainLine</option>
                  <option value="Event Exclusive">Event Exclusive</option>
                  <option value="Collaborations">Collaborations</option>
                  <option value="Resin">Resin</option>
                </select>
                </div>
          
                
                <div>
                  <h3 class="font-semibold mb-2">Brand</h3>
                  <select wire:model.live="brand" class="w-full border rounded p-2">
                    <option value="">All Brands</option>
                    <option value="MINIGT">MiniGT</option>
                    <option value="INNO">INNO</option>
                    <option value="Hot Wheels">Hot Wheels</option>
                    <option value="IGNITION MODEL">IGNITION MODEL</option>
                  </select>
                </div>
          
                
              
              </aside>
            
          
              
              <main class="md:col-span-3">
                @if($products->count())
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $p)
                      <div class="max-w-xs bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mx-auto">
                        <a href="{{ route('single-product', $p->id) }}">
                          <img src="https://storage.googleapis.com/{{ env('GCS_BUCKET') }}/{{ $p->img_url }}"
                            alt="{{ $p->product_name }}"
                            class="h-80 w-full object-cover rounded-t-xl" />

              
                          <div class="px-4 py-3">
                            <span class="text-gray-400 uppercase text-xs">{{ $p->brand }}</span>
                            <p class="text-lg font-bold text-black truncate capitalize">{{ $p->product_name }}</p>
              
                            <div class="flex items-center">
                              <p class="text-lg font-semibold text-black my-3">
                                Rs. {{ number_format($p->price, 2) }}
                              </p>
              
                              @if(!empty($p->discount_price))
                                <del class="ml-2">
                                  <p class="text-sm text-gray-600">
                                    Rs. {{ number_format($p->discount_price, 2) }}
                                  </p>
                                </del>
                              @endif
              
                              <div class="ml-auto">
                                <form action="{{ url('/cart') }}" method="POST">
                                  @csrf
                                  <button wire:click.prevent="addToCart('{{ $p->_id }}')" class="focus:outline-none">
                                    <img src="{{ asset('images/cart.png') }}" alt="Cart" class="h-6 w-6"/>
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    @endforeach
                  </div>
                @else
                  <p class="text-center text-gray-500">No products found.</p>
                @endif
              </main>
              
          
            </div>
          </div>
  