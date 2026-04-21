<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Recuperation</p>
        <h2 class="auth-heading">Nsiti mot de passe?</h2>
        <p class="auth-subtitle">Ma kaynch mochkil. Dkhel email dyalek w ghadi nsefto lik lien bach t3awed tdir mot de passe jdida.</p>
    </div>

    <div class="auth-note mb-5">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="auth-status mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="field mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <a class="auth-link" href="{{ route('login') }}">Retour a la connexion</a>
            <button type="submit" class="auth-submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
