@extends('layouts.app')

@section('title', 'Connexion - Lyon Palme')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600 mb-2">Lyon Palme</h1>
            <p class="text-gray-600">Connexion à votre espace</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe</label>
                <input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                       href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Se connecter
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Créer un compte
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
