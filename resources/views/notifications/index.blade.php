<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-5xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Notifications</h1>
                <p class="mt-1 text-sm text-slate-500">Toutes vos notifications recues.</p>
            </div>

            <div class="surface-card space-y-3">
                @forelse($notifications as $notification)
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-slate-800">{{ $notification->message }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Aucune notification.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
