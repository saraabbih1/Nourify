<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nourify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="page-shell flex items-center">
        <div class="mx-auto w-full max-w-7xl">
            <div class="mb-6 flex items-center justify-between px-2">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--primary)] text-sm font-semibold text-[var(--surface)] shadow-sm">
                        N
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--primary-strong)]">Nourify</p>
                        <p class="text-sm text-slate-500">Solidarity donation platform</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-500 transition hover:text-slate-900">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="btn-muted">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <section class="grid overflow-hidden rounded-[2rem] border border-[var(--border)] bg-[rgb(251_248_232_/_0.94)] shadow-[0_30px_80px_-45px_rgba(10,51,35,0.45)] lg:grid-cols-[1.05fr_0.95fr]">
                <div class="flex flex-col justify-between p-8 sm:p-10 lg:p-14">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[var(--primary-strong)]">
                            Nourify Platform
                        </p>
                        <h1 class="mt-6 max-w-xl text-4xl font-semibold leading-tight text-slate-900 sm:text-5xl">
                            Gerez les campagnes solidaires et simplifiez les dons avec confiance.
                        </h1>
                        <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                            Nourify centralise la creation des campagnes, la gestion des dons, les notifications,
                            l'historique des actions et les roles utilisateurs dans une seule plateforme claire.
                        </p>
                    </div>

                    <div class="mt-10 space-y-5">
                        <div class="flex items-start gap-4">
                            <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-[var(--primary)] text-xs font-bold text-white">1</span>
                            <div>
                                <p class="text-base font-semibold text-slate-900">Creer et suivre les campagnes</p>
                                <p class="mt-1 text-sm leading-7 text-slate-600">
                                    Chaque beneficiaire peut lancer sa campagne, suivre l'objectif et consulter les dons recus.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-[var(--primary)] text-xs font-bold text-white">2</span>
                            <div>
                                <p class="text-base font-semibold text-slate-900">Donner facilement et en toute transparence</p>
                                <p class="mt-1 text-sm leading-7 text-slate-600">
                                    Les utilisateurs consultent toutes les campagnes actives et peuvent proposer des dons rapidement.
                                </p>
                            </div>
                        </div>

                        <div class="pt-3">
                            @auth
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('campagnes.index') }}" class="btn-primary">Voir les campagnes</a>
                                    <a href="{{ route('dons.index') }}" class="btn-muted">Suivre les dons</a>
                                </div>
                            @else
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('register') }}" class="btn-primary">Commencer maintenant</a>
                                    <a href="{{ route('login') }}" class="btn-muted">J'ai deja un compte</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="relative min-h-[320px] overflow-hidden p-8 sm:p-10 lg:p-12" style="background: linear-gradient(180deg, rgb(10 51 35 / 0.96), rgb(16 86 102 / 0.9), rgb(131 153 88 / 0.88));">
                    <div class="absolute inset-0" style="background:
                        radial-gradient(circle at 18% 20%, rgb(247 244 213 / 0.14), transparent 26%),
                        radial-gradient(circle at 78% 28%, rgb(211 150 140 / 0.16), transparent 30%),
                        linear-gradient(135deg, transparent 0%, rgb(247 244 213 / 0.08) 100%);">
                    </div>

                    <div class="relative flex h-full flex-col justify-between">
                        <div>
                            <p class="text-[clamp(3rem,10vw,7rem)] font-semibold uppercase leading-none tracking-[-0.08em] text-[var(--surface)]">
                                Nourify
                            </p>
                            <p class="mt-4 max-w-sm text-sm leading-7 text-[rgb(247_244_213_/_0.82)]">
                                Une plateforme web pour connecter donateurs, beneficiaires et administrateurs autour d'un suivi simple et structure.
                            </p>
                        </div>

                        <div class="mt-10 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.5rem] border p-5 backdrop-blur-sm" style="border-color: rgb(247 244 213 / 0.16); background: rgb(255 255 255 / 0.08);">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[rgb(247_244_213_/_0.76)]">Modules</p>
                                <p class="mt-3 text-2xl font-semibold text-white">Campagnes</p>
                                <p class="mt-2 text-sm leading-6 text-[rgb(247_244_213_/_0.82)]">Dons, notifications, historique, gestion admin.</p>
                            </div>

                            <div class="rounded-[1.5rem] border p-5 backdrop-blur-sm" style="border-color: rgb(247 244 213 / 0.16); background: rgb(255 255 255 / 0.08);">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[rgb(247_244_213_/_0.76)]">Objectif</p>
                                <p class="mt-3 text-2xl font-semibold text-white">Confiance</p>
                                <p class="mt-2 text-sm leading-6 text-[rgb(247_244_213_/_0.82)]">Tracabilite claire et acces simple aux campagnes actives.</p>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <div class="rounded-full border px-4 py-2 text-xs font-medium uppercase tracking-[0.22em] text-[var(--surface)]" style="border-color: rgb(247 244 213 / 0.18); background: rgb(255 255 255 / 0.06);">
                                Laravel
                            </div>
                            <div class="rounded-full border px-4 py-2 text-xs font-medium uppercase tracking-[0.22em] text-[var(--surface)]" style="border-color: rgb(247 244 213 / 0.18); background: rgb(255 255 255 / 0.06);">
                                Donation Flow
                            </div>
                            <div class="rounded-full border px-4 py-2 text-xs font-medium uppercase tracking-[0.22em] text-[var(--surface)]" style="border-color: rgb(247 244 213 / 0.18); background: rgb(255 255 255 / 0.06);">
                                Role Management
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
