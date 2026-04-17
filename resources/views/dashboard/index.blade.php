<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="surface-card">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Nourify Panel</p>
                        <h1 class="mt-1 text-3xl font-semibold text-slate-900">Dashboard</h1>
                    </div>
                    <div class="rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-4">
                <div class="metric-card">
                    <p class="metric-label">Users</p>
                    <p class="metric-value">{{ $totalUsers }}</p>
                </div>
                <div class="metric-card">
                    <p class="metric-label">Campagnes</p>
                    <p class="metric-value">{{ $totalCampaigns }}</p>
                </div>
                <div class="metric-card">
                    <p class="metric-label">Dons</p>
                    <p class="metric-value">{{ $totalDons }}</p>
                </div>
                <div class="metric-card">
                    <p class="metric-label">Total MAD</p>
                    <p class="metric-value">{{ number_format($totalAmount, 0, ',', ' ') }}</p>
                </div>
            </div>

            <div class="surface-card">
                <h2 class="section-title">Quick Access</h2>
                <div class="mt-4 grid gap-3 md:grid-cols-3">
                    <a href="{{ route('campagnes.index') }}" class="quick-link">Campagnes</a>
                    <a href="{{ route('dons.index') }}" class="quick-link">Dons</a>
                    <a href="{{ route('notifications.index') }}" class="quick-link">Notifications</a>
                    <a href="{{ route('historique.index') }}" class="quick-link">Historique</a>
                    <a href="{{ route('admin.index') }}" class="quick-link">Admin</a>
                    <a href="{{ route('admin.users') }}" class="quick-link">Users</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
