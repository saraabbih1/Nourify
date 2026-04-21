<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Inscription</p>
        <h2 class="auth-heading">Creer ton espace.</h2>
        <p class="auth-subtitle">Sajjel bach tbda ttsayb dons, ttab3 campagnes, w tdkhol l plateforme بسهولة.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="field mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="auth-field-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="field mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
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
            <a class="auth-link" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="auth-submit">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
