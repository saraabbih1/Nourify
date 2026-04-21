<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Dons</h1>
                    <p class="mt-1 text-sm text-slate-500">Suivi de tous les dons enregistres.</p>
                </div>
                @if(auth()->user()->hasRole('donateur', 'admin'))
                    <a href="{{ route('dons.create') }}" class="btn-primary">Proposer un don</a>
                @endif
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
                        <th class="px-4 py-3">Valeur du don</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3">Campagne</th>
                        @if(auth()->user()->hasRole('beneficiaire', 'admin'))
                            <th class="px-4 py-3">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dons as $don)
                        <tr>
                            <td class="table-cell font-medium">
                                @if($don->type === 'argent')
                                    {{ number_format((float) $don->montant, 2, ',', ' ') }} MAD
                                @else
                                    {{ rtrim(rtrim(number_format((float) ($don->quantite ?? 0), 2, '.', ''), '0'), '.') }}
                                    {{ $don->unite ?? '' }}
                                    @if($don->description)
                                        <span class="block text-xs text-slate-500">{{ $don->description }}</span>
                                    @endif
                                @endif
                            </td>
                            <td class="table-cell">{{ $don->type ?? 'n/a' }}</td>
                            <td class="table-cell">{{ $don->statut ?? 'n/a' }}</td>
                            <td class="table-cell">
                                {{ $don->campagne?->titre ?? ('Campagne #' . $don->campagne_id) }}
                            </td>
                            @if(auth()->user()->hasRole('beneficiaire', 'admin'))
                                <td class="table-cell">
                                    <div class="flex flex-wrap gap-2">
                                        @if($don->statut === 'propose')
                                            <form method="POST" action="{{ route('dons.accepter', $don->id) }}">
                                                @csrf
                                                <button class="btn-primary" type="submit">Accepter</button>
                                            </form>
                                            <form method="POST" action="{{ route('dons.refuser', $don->id) }}">
                                                @csrf
                                                <button class="btn-danger" type="submit">Refuser</button>
                                            </form>
                                        @elseif($don->statut === 'accepte')
                                            <form method="POST" action="{{ route('dons.distribuer', $don->id) }}">
                                                @csrf
                                                <button class="btn-muted" type="submit">Distribuer</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasRole('beneficiaire', 'admin') ? 5 : 4 }}"
                                class="table-cell text-center text-slate-500">
                                Aucun don trouve.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
