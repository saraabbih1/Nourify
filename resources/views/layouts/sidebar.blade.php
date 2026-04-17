<aside class="border-b border-slate-200 bg-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
    <div class="px-5 py-5">
        <a href="{{ route('dashboard') }}" class="block">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nourify</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-900">Dashboard</h2>
        </a>
    </div>

    <nav class="space-y-1 px-3 pb-6">
        <a href="{{ route('dashboard') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Dashboard
        </a>
        <a href="{{ route('campagnes.index') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('campagnes.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Campagnes
        </a>
        <a href="{{ route('dons.index') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dons.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Dons
        </a>
        <a href="{{ route('notifications.index') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('notifications.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Notifications
        </a>
        <a href="{{ route('historique.index') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('historique.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Historique
        </a>
        <a href="{{ route('admin.index') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.index') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Admin
        </a>
        <a href="{{ route('admin.users') }}"
           class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.users') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
            Users
        </a>
    </nav>
</aside>
