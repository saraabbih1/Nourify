<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Connexion</p>
        <h2 class="auth-heading">Rebienvenue.</h2>
        <p class="auth-subtitle">Connecte-toi pour suivre tes dons, tes campagnes, et les actions recentes.</p>
    </div>

    <x-auth-session-status class="auth-status mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="field mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-field-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="field mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="auth-actions">
            <a class="auth-link" href="{{ route('register') }}">
                {{ __('Create an account') }}
            </a>

            <button type="submit" class="auth-submit">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
