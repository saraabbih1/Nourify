<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Dons</h1>
                    <p class="mt-1 text-sm text-slate-500">Suivi de tous les dons enregistres.</p>
                </div>
                <a href="{{ route('dons.create') }}" class="btn-primary">Proposer un don</a>
            </div>

            @if(session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-shell">
                <table class="w-full">
                    <thead class="table-head">
                    <tr>
                        <th class="px-4 py-3">Montant</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3">Campagne</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dons as $don)
                        <tr>
                            <td class="table-cell font-medium">{{ number_format($don->montant, 0, ',', ' ') }} MAD</td>
                            <td class="table-cell">{{ $don->statut ?? 'n/a' }}</td>
                            <td class="table-cell">#{{ $don->campagne_id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="table-cell text-center text-slate-500">Aucun don trouve.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
