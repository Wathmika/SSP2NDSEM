<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <form wire:submit.prevent="processPayment" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
  
      <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
        <div class="min-w-0 flex-1 space-y-8">
          <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Details</h2>
  
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div>
                <label for="your_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Full Name </label>
                <input wire:model.defer="name" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Name" required />
                @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
              </div>
  
              <div>
                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Email </label>
                <input wire:model.defer="email" type="email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Email" required />
                @error('email')<span class="text-red-600">{{ $message }}</span>@enderror
              </div>
  
              <div>
                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Address </label>
                <input wire:model.defer="address" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Adress" required />
                @error('address')<span class="text-red-600">{{ $message }}</span>@enderror
              </div>
  
              <div>
                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Postal Code </label>
                <input wire:model.defer="postal_code" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Postal Code" required />
                @error('postal_code')<span class="text-red-600">{{ $message }}</span>@enderror
              </div>
  
              <div>
                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Phone Number </label>
                <input wire:model.defer="phone" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Phone Number" required />
                @error('phone')<span class="text-red-600">{{ $message }}</span>@enderror
              </div> 
            </div>
          </div>

          <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div>
                <label class="block text-sm font-medium">Name on Card</label>
                <input wire:model.defer="card_name" type="text"
                       class="mt-1 block w-full rounded-lg border p-2.5"
                       placeholder="Full Name on Card" />
                @error('card_name') <span class="text-red-600">{{ $message }}</span> @enderror
              </div>
              <div>
                <label class="block text-sm font-medium">Card Number</label>
                <input wire:model.defer="card_number" type="text"
                       class="mt-1 block w-full rounded-lg border p-2.5"
                       placeholder="1234 5678 9012 3456" />
                @error('card_number') <span class="text-red-600">{{ $message }}</span> @enderror
              </div>
              <div>
                <label class="block text-sm font-medium">Expiration (MM/YY)</label>
                <input wire:model.defer="expiration" type="text"
                       class="mt-1 block w-full rounded-lg border p-2.5"
                       placeholder="MM/YY" />
                @error('expiration') <span class="text-red-600">{{ $message }}</span> @enderror
              </div>
              <div>
                <label class="block text-sm font-medium">CVV</label>
                <input wire:model.defer="cvv" type="text"
                       class="mt-1 block w-full rounded-lg border p-2.5"
                       placeholder="123" />
                @error('cvv') <span class="text-red-600">{{ $message }}</span> @enderror
              </div>
            </div>
            <button type="submit"
                    class="w-full bg-primary-700 text-white px-5 py-2.5 rounded-lg hover:bg-primary-800">
              Pay now
            </button>
            @if(session()->has('success'))
              <div class="bg-green-200 p-2 rounded mt-3">
                {{ session('success') }}
              </div>
            @endif
          </div>

        </div>

        

        
        
        
      <div class="mt-6 w-full max-w-xs xl:max-w-md space-y-6">
        <div class="flow-root bg-gray-50 p-4 rounded-lg">
          @php
            $subtotal = array_sum(array_column($cartItems, 'Total_Price'));
            $delivery = 99;
            $tax      = 0.10 * $subtotal;
            $total    = $subtotal + $delivery + $tax;
          @endphp

          <dl class="divide-y">
            <div class="py-3 flex justify-between"><dt>Subtotal</dt><dd>Rs. {{ number_format($subtotal,2) }}</dd></div>
            <div class="py-3 flex justify-between"><dt>Delivery</dt><dd>Rs. {{ number_format($delivery,2) }}</dd></div>
            <div class="py-3 flex justify-between"><dt>Tax (10%)</dt><dd>Rs. {{ number_format($tax,2) }}</dd></div>
            <div class="pt-3 flex justify-between font-bold"><dt>Total</dt><dd>Rs. {{ number_format($total,2) }}</dd></div>
          </dl>
        </div>
      </div>
    </div>
  </form>
</section>
