@extends('layouts.admincanvas')

@section('content')
<div class="container mx-auto p-4">
    
    <nav class="bg-white shadow-md rounded px-8 pt-6 pb-6 mb-4 flex justify-between items-center">
        <span class="font-bold text-xl">Dope Diecast</span>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin') }}">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Admin Dashboard
                </button>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        <h2 class="text-xl font-bold mb-4">Add Product</h2>
        <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                    <input name="product_name" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Product Name">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product Price</label>
                    <input name="price" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="number" step="0.01" placeholder="Product Price">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                    <input name="qty" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Stock Quantity">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <input name="category" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Category">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Brand</label>
                    <input name="brand" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Brand">
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" rows="3"
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        placeholder="Description"></textarea>
                </div>
                <div>
                    <div class="col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Discount</label>
                        <input name="discount" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Discount">
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail Image</label>
                    <input name="img_url" required type="file"
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" name="Addproduct"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Product
                </button>
            </div>
        </form>
    </div>

    
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        <h2 class="text-xl font-bold mb-4"> Product Update</h2>

        
        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product ID</label>
                    <input name="id" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Product ID">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail Image</label>
                    <input name="img_url" type="file"
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                    <input name="price" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Price">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                    <input name="qty" required
                        class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Stock Quantity">
            </div>
            <div class="mt-6 px-1">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>


<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
    <h2 class="text-xl font-bold mb-4"> Product Remove</h2>
    <form action="{{ route('product.delete') }}" method="POST">
        @csrf
        @method('DELETE')
    
        <div>
          <label class="block text-sm font-bold mb-1">Product ID to remove</label>
          <input name="id" type="text" required
                 class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                 placeholder="123">
        </div>
        <div class="mt-6">
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
          Remove Product
        </button>
        </div>
    </form> 
</div>

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
    
    <section class="bg-gray-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4"> All Products</h2>
        @if(session('message'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-2 px-4">ID</th>
                        <th class="py-2 px-4">Image</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Price</th>
                        <th class="py-2 px-4">Stock</th>
                        <th class="py-2 px-4">Category</th>
                        <th class="py-2 px-4">Brand</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $product->id }}</td>
                            <td class="py-3 px-4">
                                <img src="https://storage.googleapis.com/{{ env('GCS_BUCKET') }}/{{ $product->img_url }}" alt="{{ $product->product_name }}"class="w-16 h-16 object-cover rounded" />
                            </td>
                            <td class="py-3 px-4">{{ $product->product_name }}</td>
                            <td class="py-3 px-4">Rs {{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4">{{ $product->qty }}</td>
                            <td class="py-3 px-4">{{ $product->category }}</td>
                            <td class="py-3 px-4">{{ $product->brand }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">
                                No products available
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
