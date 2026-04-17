<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Campagnes</h1>
                    <p class="mt-1 text-sm text-slate-500">Liste des campagnes disponibles.</p>
                </div>
                <a href="{{ route('campagnes.create') }}" class="btn-primary">Nouvelle campagne</a>
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
                        <th class="px-4 py-3">Titre</th>
                        <th class="px-4 py-3">Objectif</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($campagnes as $campagne)
                        <tr>
                            <td class="table-cell font-medium">{{ $campagne->titre }}</td>
                            <td class="table-cell">{{ number_format($campagne->objectif, 0, ',', ' ') }} MAD</td>
                            <td class="table-cell">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('campagnes.show', $campagne->id) }}" class="btn-muted">Voir</a>
                                    <a href="{{ route('campagnes.edit', $campagne->id) }}" class="btn-muted">Edit</a>
                                    <form method="POST" action="{{ route('campagnes.destroy', $campagne->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="table-cell text-center text-slate-500">Aucune campagne trouvee.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
