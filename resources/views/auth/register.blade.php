@extends('layouts.app')

@section('title', 'Inscription - Lyon Palme')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600 mb-2">Lyon Palme</h1>
            <p class="text-gray-600">Créer votre compte</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nom complet</label>
                <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                       type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                       type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe</label>
                <input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                   href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    S'inscrire
                </button>
            </div>

            <!-- Information -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    En vous inscrivant, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
