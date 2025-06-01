<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
  
      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
          <div class="space-y-6">
            @forelse ($cartItems as $item)
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
              <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                <a href="{{ url('/product/' . $item['ProductID']) }}" class="shrink-0 md:order-1">
                  <img class="h-20 dark:hidden" src="https://storage.googleapis.com/{{ env('GCS_BUCKET') }}/{{ $item['img_url'] }}" alt="{{ $item['product_name'] }}" />
                  <img class="hidden h-20 w-20 dark:block" src="{{ asset($item['img_url']) }}" alt="{{ $item['product_name'] }}" />
              </a>
              
  
                <label for="counter-input-{{ $item['ItemID'] }}" class="sr-only">Choose quantity:</label>
                <div class="flex items-center justify-between md:order-3 md:justify-end">
                  <div class="flex items-center">
                    <button wire:click="decrementQuantity('{{ $item['ItemID']}}')" type="button" class="border rounded-md py-2 px-4 mr-2">-</button>
                    <span class="w-8 inline-block text-center">{{ $item['Quantity'] }}</span>
                    <button wire:click="incrementQuantity('{{ $item['ItemID'] }}')" type="button" class="border rounded-md py-2 px-4 ml-2">+</button>
                  </div>
                  <div class="text-end md:order-4 md:w-32">
                    <p class="text-base font-bold text-gray-900 dark:text-white">Rs. {{ number_format($item['Total_Price'], 2) }}</p>
                  </div>
                </div>
  
                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a href="{{ url('/product/' . $item['ProductID']) }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item['product_name'] }}</a>
    
                    <div class="flex items-center gap-4">
  
                      <button wire:click="removeItem('{{ $item['ItemID'] }}')" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Remove
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              @empty
            <p>Your cart is empty.</p>
          @endforelse
        </div>
      </div>
      
      <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
          <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

          @php
            $subtotal = array_sum(array_column($cartItems, 'Total_Price'));
            $delivery = 99; 
            $tax = 0.10 * $subtotal; 
            $total = $subtotal + $delivery + $tax;
        @endphp

          <div class="space-y-4">
            <dl class="flex items-center justify-between gap-4">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rs. {{ number_format($subtotal, 2) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Delivery</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rs. {{ number_format($delivery, 2) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rs. {{ number_format($tax, 2) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-white">Rs. {{ number_format($total, 2) }}</dd>
            </dl>
          </div>

          <a href="{{ route('checkout') }}"
              class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Proceed to Checkout
          </a>

        </div>
      </div>
    </div>
  </section>
