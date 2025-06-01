<header class="bg-white border-b shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Left: Logo -->
            <div class="flex-shrink-0 px-10">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/dd_icon.png') }}" alt="Dope Diecast" class=""/>
                </a>
            </div>

            <!-- Center: Navigation -->
            <nav class="md:flex space-x-12 text-xl font-semibold text-gray-800">
                <a href="{{ url('/') }}" class="hover:text-black">HOME</a>
                <a href="{{ url('/shop') }}" class="hover:text-black">SHOP</a>
                <a href="{{ url('/contact') }}" class="hover:text-black">CONTACT</a>
            </nav>

            <!-- Right: Icons -->
            <div class="flex items-center space-x-12">
                <!-- User Icon -->
                @auth
                <x-dropdown align="right" width="48">
                    {{-- Trigger: the user icon (and caret) --}}
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm focus:outline-none transition">
                            {{-- User Icon --}}
                            <img
                                src="{{ asset('images/user.png') }}"
                                alt="User"
                                class="h-6 w-6"
                            />
                            {{-- User’s Name (optional) --}}
                            <span class="ml-2 font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            {{-- Down-caret SVG --}}
                            <svg
                                class="ml-1 h-4 w-4 text-gray-500"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 
                                       10.586l3.293-3.293a1 1 0 111.414 
                                       1.414l-4 4a1 1 0 01-1.414 
                                       0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </x-slot>

                    {{-- Dropdown Content: Profile & Logout --}}
                    <x-slot name="content">
                        {{-- Link to Profile --}}
                        <x-dropdown-link :href="route('profile.show')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        {{-- Logout Form --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        <div class="border-t border-gray-100"></div>

                        <x-dropdown-link :href="route('user.orders')">
                            My Orders
                        </x-dropdown-link>
                        
                    </x-slot>
                </x-dropdown>
            @else
                {{-- If not authenticated, you can show a “Login” link (optional) --}}
                <a
                    href="{{ route('login') }}"
                    class="text-gray-700 hover:text-gray-900 font-medium"
                >
                    Login
                </a>
            @endauth

                <!-- Cart Icon -->
                <a href="{{ url('/cart') }}">
                    <img src="{{ asset('images/cart.png') }}" alt="Cart" class="h-6 w-6"/>
                </a>
            </div>
    </div>
</header>

