
@extends('layouts.app')

@section('content')
<div class="mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Order Details</h2>

    
    <div class="mb-6 border-b pb-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h4 class="text-lg font-medium text-gray-700">Order ID</h4>
                <p class="mt-1 text-gray-900">{{ $order['_id'] }}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-700">User ID</h4>
                <p class="mt-1 text-gray-900">{{ $order['User_ID'] }}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-700">Order Date</h4>
                <p class="mt-1 text-gray-900">
                    {{ \Carbon\Carbon::parse($order['OrderDate'])->format('F j, Y g:i A') }}
                </p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-700">Status</h4>
                <p class="mt-1 inline-block rounded-full 
                    @if($order['Status'] === 'completed')
                    @elseif($order['Status'] === 'processing') 
                    @elseif($order['Status'] === 'cancelled') 
                    @else bg-gray-100 text-gray-700 @endif
                    px-3 py-1 text-sm font-semibold">
                    {{ ucfirst($order['Status']) }}
                </p>
            </div>
        </div>
    </div>

    
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Shipping Address</h3>
        <p class="text-gray-700 leading-relaxed">{{ $order['ShippingAddress'] }}</p>
    </div>

    
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Items in this Order</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price (each)</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order['items'] as $item)
                        <tr class="{{ $loop->even ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-4 py-2">
                                
                                {{ $item['product_name'] ?? $item['_id'] }}
                            </td>
                            <td class="px-4 py-2">{{ $item['Quantity'] }}</td>
                            <td class="px-4 py-2">Rs.{{ number_format($item['Price'], 2) }}</td>
                            <td class="px-4 py-2">Rs.{{ number_format($item['Total_Price'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                No items found for this order.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="flex justify-end border-t pt-4">
        <div class="text-right">
            <p class="text-lg font-medium text-gray-700">Subtotal:</p>
            @php
                
                $computedSubtotal = collect($order['items'])->sum(fn($i) => $i['Total_Price']);
            @endphp
            <p class="text-xl font-semibold text-gray-900 mb-2">Rs.{{ number_format($computedSubtotal, 2) }}</p>

            <p class="text-lg font-medium text-gray-700">Delivery Fee:</p>
            <p class="text-lg text-gray-900 mb-2">Rs.{{ number_format($order['Delivery_Fee'], 2) }}</p>

            <p class="text-lg font-medium text-gray-700">Grand Total:</p>
            <p class="text-2xl font-bold text-gray-900">Rs.{{ number_format($order['TotalAmount'], 2) }}</p>
        </div>
    </div>

    
    <div class="mt-6">
        <a href="{{ route('admin') }}"
           class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium 
                  py-2 px-4 rounded transition">
            ← Back to Orders
        </a>
    </div>
</div>
@endsection
