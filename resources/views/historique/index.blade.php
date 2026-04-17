<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-5xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Historique</h1>
                <p class="mt-1 text-sm text-slate-500">Dernieres actions dans la plateforme.</p>
            </div>

            <div class="surface-card space-y-3">
                @forelse($historiques as $historique)
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-slate-800">{{ $historique->action }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $historique->created_at }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Aucun historique trouve.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
