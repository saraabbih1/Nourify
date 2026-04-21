<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Reset</p>
        <h2 class="auth-heading">Khtar mot de passe jdida.</h2>
        <p class="auth-subtitle">Rjja3 l-access dyalek b mot de passe amna w sahla ttfakar.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="field mt-1 block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-field-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="field mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="auth-field-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="field mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <a class="auth-link" href="{{ route('login') }}">Retour a la connexion</a>
            <button type="submit" class="auth-submit">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
