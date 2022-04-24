<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="#" class="container flex">
                <img src="images/logo_oficial.png" alt="Logo UCN" width="150px" height="auto">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="rut" :value="__('Rut')"/>

                <x-input id="rut" class="block mt-1 w-full" type="rut" name="rut" :value="old('rut')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>





            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('INICIAR SESIÓN') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
