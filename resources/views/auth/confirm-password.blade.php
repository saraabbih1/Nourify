<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Confirmation</p>
        <h2 class="auth-heading">Akked mot de passe dyalek.</h2>
        <p class="auth-subtitle">Hadi zone securisee, donc khassna confirmation qbl ma nkemlou.</p>
    </div>

    <div class="auth-note mb-5">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
        @csrf

        <div class="auth-field-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="field mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="auth-actions justify-end">
            <button type="submit" class="auth-submit">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
