@vite('resources/css/app.css')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

@include('layouts.navigation')

<div class="bg-gray-500 min-h-screen flex items-center justify-center p-4 mt-16">

    <div class="w-full bg-gray-700 max-w-md p-6 rounded-lg shadow-md border border-gray-600 custom-shadow" style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);">

        <h2 class="text-center mb-8 mt-8 text-white">Login</h2>
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <!-- Email-->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <x-text-input id="password" class="block mt-3 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" />
                    <label for="remember_me" class="ml-2 block text-sm text-white">{{ __('Remember me') }}</label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('auth.reset-password') }}" class="text-white hover:underline hover:text-blue-500">{{ __('Forgot your password?') }}</a>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4 w-full">
                <a class="underline text-sm text-white rounded-md focus:outline-none hover:text-blue-500" href="{{ route('register') }}">
                    {{ __('Don\'t have an account? Register') }}
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold w-[150px] p-2 rounded-md transition">
                    {{ __('Login') }}
                </button>

            </div>

        </form>

    </div>

</div>

@include('layouts.footer')
