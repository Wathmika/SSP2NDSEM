@extends('layouts.app')

@section('content')

    <div class="banner relative bg-cover bg-center h-96 md:h-[600px] lg:h-[700px] xl:h-[800px]"  
        style="background-image:url('{{ asset('images/rx7.webp') }}')">
    <div class="swiper-slide-content absolute bottom-0 right-0 flex flex-col items-end justify-end text-right p-6 md:p-10">
        <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">INNO64 Models</h2>
            <p class="mb-4 text-white md:text-2xl"> Experience the best in diecast with <br>our latest collection.</p>
            <a href="{{ url('/shop') }}"class="bg-red-500 hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block">Shop now</a>
    </div>
    </div>

    <section class="bg-white shadow p-3">
        <div class="text-center">
            <h2 class="text-5xl font-bold mb-4">Discover Global Brands</span></h2>
            <p class="my-7 font">Explore the top brands we feature in our store</p>
        </div>
    <div class="grid grid-cols-4 gap-4">
        <img src="{{asset('images/inno64_logo.png')}}" class="h-40 w-auto object-contain mx-auto">
        <img src="{{asset('images/hotwheels_logo.jpg')}}" class="h-40 w-auto object-contain mx-auto">
        <img src="{{asset('images/moreart_logo.webp')}}" class="h-40 w-auto object-contain mx-auto">
        <img src="{{asset('images/MINI_GT_logo.png')}}" class="h-20 w-auto object-contain mx-auto mt-8">
    </div>
    </section>

    @if($products->count() > 0)
    <section class="bg-white shadow mt-1 p-6">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold  mb-4 px-6">Latest Models</h2>
        <div class="grid grid-cols-4 gap-4">
            @foreach($products as $p)
                      <div class="max-w-xs bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl mx-auto">
                        <a href="{{ route('single-product', $p->id) }}">
                          <img src="https://storage.googleapis.com/{{ env('GCS_BUCKET') }}/{{ $p->img_url }}" alt="{{ $p->product_name }}"class="h-80 w-full object-cover rounded-t-xl" />
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
    </div>
    </section>
    @else
        <p class="text-gray-600 text-center mt-6">No products available.</p>
    @endif
    <section class="bg-white shadow">
      <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8 mt-1">
          <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
              <div class="max-w-lg">
                  <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">About Us</h2>
                  <p class="text-gray-700 leading-relaxed">
                    Welcome to Diecast Culture, your ultimate destination for enthusiasts of 1:64 scale diecast models. At Diecast Culture, we pride ourselves on curating an extensive collection of premium diecast, catering to the diverse tastes of collectors and hobbyists alike.
                    Our inventory spans a vast array of renowned brands, ensuring that every enthusiast finds something to pique their interest. From the iconic Hot Wheels and classic Matchbox to the exquisite craftsmanship of Inno64 and Tarmac Works, we offer a comprehensive selection that captures the essence of diecast culture.
                    <br><br>
                    But we're not just about cars – our passion extends to the finer details, including meticulously crafted dioramas and intricately designed 1:64 scale mini figures. Whether you're a seasoned collector or a newcomer to the hobby, our diverse range ensures there's something for everyone to enjoy.
                    At Diecast Culture, we're more than just a retailer – we're a community united by our shared love for diecast models. Our dedication to quality, authenticity, and customer satisfaction sets us apart, making us the preferred destination for diecast enthusiasts worldwide.
                    Explore our collection today and immerse yourself in the vibrant world of 1:64 diecast culture. Welcome to Diecast Culture – where passion meets precision.
                </p>
                  <div class="mt-8">
                      <a href="#" class="text-blue-500 hover:text-blue-600 font-medium">Learn more about us
                          <span class="ml-2">&#8594;</span></a>
                  </div>
              </div>
              <div class="mt-12 md:mt-0">
                  <img src="{{asset("images/lb.avif")}}" alt="About Us Image" class="object-cover rounded-lg shadow-md">
              </div>
          </div>
      </div>
  </section>
@endsection



