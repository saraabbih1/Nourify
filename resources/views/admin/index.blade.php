<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Admin Dashboard</h1>
                    <p class="mt-1 text-sm text-slate-500">Vue globale de la plateforme.</p>
                </div>
                <a href="{{ route('admin.users') }}" class="btn-primary">Gerer les users</a>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <div class="metric-card">
                    <p class="metric-label">Users</p>
                    <p class="metric-value">{{ $usersCount }}</p>
                </div>
                <div class="metric-card">
                    <p class="metric-label">Campagnes</p>
                    <p class="metric-value">{{ $campaignsCount }}</p>
                </div>
                <div class="metric-card">
                    <p class="metric-label">Dons</p>
                    <p class="metric-value">{{ $donsCount }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
