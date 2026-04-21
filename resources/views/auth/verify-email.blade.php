<x-guest-layout>
    <div class="auth-header">
        <p class="auth-badge">Verification</p>
        <h2 class="auth-heading">Verifie ton email.</h2>
        <p class="auth-subtitle">Khassna n2akdo l'adresse dyalek bach tkمل l-access l-platforme b amane.</p>
    </div>

    <div class="auth-note mb-5">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-status mb-5 font-medium">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="auth-actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="auth-submit">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="auth-link">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
