
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class=" sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto mt-8">

            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 border-b">Order ID</th>
                        <th class="py-2 px-4 border-b">Total Amount</th>
                        <th class="py-2 px-4 border-b">Order Status</th>
                        <th class="py-2 px-4 border-b">Shipping Address</th>
                        <th class="py-2 px-4 border-b">Order Date &amp; Time</th>
                        <th class="py-2 px-4 border-b">View Order</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            
                            <td class="py-2 px-4">{{ $order->_id }}</td>

                            
                            <td class="py-2 px-4">
                                Rs.{{ number_format($order->TotalAmount, 2) }}
                            </td>

                            
                            <td class="py-2 px-4">
                                @php
                                    $status = strtolower($order->Status);
                                    $statusClasses = [
                                        'completed'  => 'bg-green-100 text-green-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'cancelled'  => 'bg-red-100 text-red-700',
                                        'pending'    => 'bg-yellow-100 text-yellow-700',
                                    ];
                                    $labelClass = $statusClasses[$status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="{{ $labelClass }} text-[13px] font-medium inline-block rounded-md py-1 px-2">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            
                            <td class="py-2 px-4">{{ $order->ShippingAddress }}</td>

                            
                            <td class="py-2 px-4">
                                {{ \Carbon\Carbon::parse($order->OrderDate)->format('F j, Y g:i A') }}
                            </td>

                            
                            <td class="py-2 px-4">
                                <a href="{{ route('orders.show', $order->_id) }}">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded"
                                    >
                                        View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                You have no orders yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
