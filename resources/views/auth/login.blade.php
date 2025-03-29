<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Login (Username atau Email) -->
        <div class="relative">
            <x-input-label for="login" :value="__('Username/Email')" class="sr-only" />

            <!-- Icon SVG -->
            <div class="absolute px-2 left-0 top-1/2 transform -translate-y-1/2">
                <svg width="29" height="24" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M14.2999 11.2435C11.0705 11.2435 10.4161 7.2665 10.4161 7.2665C10.032 5.19705 11.1986 2.86169 14.2572 2.86169C17.3302 2.86169 18.4967 5.19705 18.1126 7.2665C18.1126 7.2665 17.5293 11.2435 14.2999 11.2435ZM14.2999 14.2148L18.1695 12.1106C21.5696 12.1106 24.5998 14.8044 24.5998 17.3478V20.2266C24.5998 20.2266 19.4072 21.533 14.2999 21.533C9.10728 21.533 4 20.2266 4 20.2266V17.3478C4 14.7466 6.75993 12.1684 10.3592 12.1684L14.2999 14.2148Z"
                        fill="#063970"></path>
                </svg>
            </div>

            <x-text-input id="login"
                class="pl-12 h-12 text-xl text-primary font-medium w-full max-sm:w-full outline-none focus:outline-none"
                type="text" name="login" :value="old('login')" required autofocus autocomplete="username"
                placeholder="Username" />

            <x-input-error :messages="$errors->get('login')" class="mt-2" />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="relative mt-1">
                <x-input-label for="password" :value="__('Password')" class="sr-only" />

                <!-- Icon Gembok -->
                <div class="absolute pl-4 top-1/2 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="21" viewBox="0 0 19 21"
                        fill="none">
                        <path
                            d="M14.9135 7.19281V5.1742C14.9135 2.34813 12.4057 0.127655 9.21386 0.127655C6.02203 0.127655 3.51417 2.34813 3.51417 5.1742V7.19281C1.57628 7.19281 0.0943604 8.50492 0.0943604 10.2207V17.2859C0.0943604 19.0017 1.57628 20.3138 3.51417 20.3138H14.9135C16.8514 20.3138 18.3334 19.0017 18.3334 17.2859V10.2207C18.3334 8.50492 16.8514 7.19281 14.9135 7.19281ZM5.79405 5.1742C5.79405 3.45837 7.27596 2.14627 9.21386 2.14627C11.1518 2.14627 12.6337 3.45837 12.6337 5.1742V7.19281H5.79405V5.1742ZM10.4678 13.7533L10.3538 13.8543V15.2673C10.3538 15.8729 9.89782 16.2766 9.21386 16.2766C8.5299 16.2766 8.07392 15.8729 8.07392 15.2673V13.8543C7.38996 13.2487 7.27596 12.3403 7.95993 11.7347C8.64389 11.1291 9.66983 11.0282 10.3538 11.6338C11.0378 12.1384 11.1518 13.1477 10.4678 13.7533Z"
                            fill="#063970" />
                    </svg>
                </div>

                <x-text-input id="password"
                    class="pl-12 h-12 text-xl text-primary font-medium w-full max-sm:w-full outline-none focus:outline-none"
                    type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
