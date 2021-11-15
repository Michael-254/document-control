<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('images/create-account-office.jpeg') }}" alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/create-account-office-dark.jpeg" alt="Office" />
        </div>

        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    Create account
                </h1>

                <x-auth-validation-errors :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4">
                        <x-label :value="__('Name')" />
                        <input type="text" id="name" name="name" class="block w-full btn-blue mt-2" value="{{ old('name') }}" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Email')" />
                        <input name="email" type="email" class="block w-full btn-blue mt-2" value="{{ old('email') }}" />
                    </div>

                    <div class="mt-4">
                        <x-label for="site" :value="__('Site')" />

                        <select id="site" class="block w-full btn-blue mt-2" name="site" required>
                            <option value="">--Select Site--</option>
                            <option value="Head Office">Head Office</option>
                            <option value="Nyongoro">Nyongoro</option>
                            <option value="Kiambere">Kiambere</option>
                            <option value="Dokolo">Dokolo</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="department" :value="__('Department')" />

                        <select id="department" class="block w-full btn-blue mt-2" name="department" required>
                            <option value="">--Select Department--</option>
                            <option value="Forestry">Forestry</option>
                            <option value="Operations">Operations</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                            <option value="Communications">Communications</option>
                            <option value="Miti Magazine">Miti Magazine</option>
                            <option value="Accounts">Accounts</option>
                            <option value="ME">M&E</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Password')" />
                        <input type="password" name="password" class="block w-full btn-blue mt-2" required />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Confirm Password')" />
                        <input type="password" name="password_confirmation" class="block w-full btn-blue mt-2" required />
                    </div>

                    <div class="mt-4">
                        <x-button class="block w-full">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>

                <p class="mt-4 flex justify-end">
                    <a class="text-sm font-bold text-green-600 dark:text-primary-400 hover:underline" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                </p>
            </div>
        </div>
</x-guest-layout>