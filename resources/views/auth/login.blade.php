<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/dd1_logo.png') }}" alt="Your App Name"class="w- h-20" />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mt-4 w-full">
                <x-button 
                    class="w-full bg-black text-white rounded-full py-3 text-lg font-semibold hover:bg-gray-800 transition flex justify-center items-center">
                    {{ __('Log in') }}
                </x-button>
            </div>
    
            

            <div class="mt-6 text-center space-y-2">
                <p class="text-sm text-gray-700">
                    {{ __("Don't have an account?") }}
                    <a
                        href="{{ route('register') }}"
                        class="text-indigo-600 hover:underline"
                    >
                        {{ __('Create an account') }}
                    </a>
                </p>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
