<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        <div class="flex-shrink-0 flex items-center">
                <a href="#" class="container flex">
                <img src="{{ asset('images/logo_oficial.png') }}" alt="ucn" width="150px" height="auto">
                </a>
                </div>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Rut -->
            <div>
                <x-label for="rut" :value="__('Rut')" />

                <x-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <select id="role" type="role" name="role" :value="old('role')" >
                <option selected value="0"> Elige una opción </option>
                <option value="estudiante">Alumno</option>
                <option value="docente">Docente</option>
                <option value="ayudante">Ayudante</option>

            </select>


                <x-button class="ml-4">
                    {{ __('INGRESAR USUARIO') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
