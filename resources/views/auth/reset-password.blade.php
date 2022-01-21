<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('images/forgot-password-office.jpeg') }}" alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/forgot-password-office-dark.jpeg" alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    Forgot password
                </h1>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mt-4">
                        <x-label :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full btn-blue" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Password')" />
                        <input type="password" name="password" class="block w-full btn-blue mt-2" required />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Confirm Password')" />
                        <input type="password" name="password_confirmation" class="block w-full btn-blue mt-2" required />
                    </div>

                    <x-button class="mt-4 w-full">
                        {{ __('Reset Password') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>