@extends('layouts.admincanvas')
@section('content')
<div class="container mx-auto p-4">
    
    <nav class="bg-white shadow-md rounded px-8 pt-6 pb-6 mb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <span class="font-bold text-xl">Dope Diecast</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('product.management') }}">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Product Management
                    </button>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    
    <div class="relative overflow-x-auto">
        <h2 class="text-xl font-bold mb-4">Users</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="py-2 px-4 border-b">User ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b"></th>
                    <th class="py-2 px-4 border-b">Contact Number</th>
                    <th class="py-2 px-4 border-b">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-2 px-4">{{ $user->id}}</td>
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">{{ $user->phone}}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-2 px-4 text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    
    <div class="relative overflow-x-auto mt-8">
        <h2 class="text-xl font-bold mb-4">Orders</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="py-2 px-4 border-b">Order ID</th>
                    <th class="py-2 px-4 border-b">User ID</th>
                    <th class="py-2 px-4 border-b">Total Amount</th>
                    <th class="py-2 px-4 border-b">Order Status</th>
                    <th class="py-2 px-4 border-b">Shipping Address</th>
                    <th class="py-2 px-4 border-b">Order Date & Time</th>
                    <th class="py-2 px-4 border-b">View Order</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-2 px-4">{{ $order->_id }}</td>
                        <td class="py-2 px-4">{{ $order->User_ID }}</td>
                        <td class="py-2 px-4">Rs.{{ number_format($order->TotalAmount, 2) }}</td>
                        <td class="py-2 px-4">
                            <form method="POST"
                                  action="{{ route('admin.orders.update', $order->_id) }}">
                              @csrf
                              @method('PATCH')
                    
                              <select name="Status"
                                      onchange="this.form.submit()"
                                      class="bg-white border rounded py-1">
                                      <option value="pending"    {{ $order->Status === 'pending'    ? 'selected' : '' }}>Pending</option>
                                      <option value="processing" {{ $order->Status === 'processing' ? 'selected' : '' }}>Processing</option>
                                      <option value="done"       {{ $order->Status === 'done'       ? 'selected' : '' }}>Done</option>
                                      <option value="cancelled"  {{ $order->Status === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                              </select>
                            </form>
                          </td>
                        <td class="py-2 px-4">{{ $order->ShippingAddress }}</td>
                        <td class="py-2 px-4">{{ $order->OrderDate }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('orders.show', $order->_id) }}">
                                <button
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                    View
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-2 px-4 text-center">No orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection