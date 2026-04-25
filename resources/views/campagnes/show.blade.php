<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-5xl space-y-6">
            <div class="surface-card">
                <h1 class="text-3xl font-semibold text-slate-900">{{ $campagne->titre }}</h1>
                <p class="mt-2 text-slate-600">{{ $campagne->description }}</p>
                <p class="mt-4 text-sm font-medium text-slate-500">
                    Objectif: {{ number_format($campagne->objectif, 0, ',', ' ') }} MAD
                </p>
                <p class="mt-2 text-sm font-medium text-slate-500">
                    Montant collecte: {{ number_format($campagne->montant_collecte, 0, ',', ' ') }} MAD
                </p>
                <p class="mt-2 text-sm font-medium {{ $campagne->statut === 'objectif_atteint' ? 'text-green-600' : 'text-slate-500' }}">
                    Statut: {{ $campagne->statut === 'objectif_atteint' ? 'Objectif atteint' : 'Active' }}
                </p>

                @if($campagne->statut === 'objectif_atteint')
                    <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        Cette campagne a atteint son objectif. Merci pour votre soutien.
                    </div>
                @endif
            </div>

            <div class="surface-card">
                <h2 class="section-title">Dons de cette campagne</h2>
                <div class="mt-4 space-y-3">
                    @forelse($campagne->dons as $don)
                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="font-medium text-slate-800">{{ number_format($don->montant, 0, ',', ' ') }} MAD</p>
                            <p class="text-sm text-slate-500">Statut: {{ $don->statut ?? 'n/a' }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Pas encore de dons pour cette campagne.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
