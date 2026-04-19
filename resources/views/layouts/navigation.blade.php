<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-slate-900">Nourify</a>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('dashboard') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Dashboard
            </a>
            <a href="{{ route('campagnes.index') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('campagnes.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Campagnes
            </a>
            <a href="{{ route('dons.index') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dons.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Dons
            </a>
            <a href="{{ route('notifications.index') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('notifications.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Notifications
            </a>
            <a href="{{ route('historique.index') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('historique.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Historique
            </a>
            @if(auth()->check() && auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.index') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.index') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    Admin
                </a>
                <a href="{{ route('admin.users') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.users') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    Users
                </a>
            @endif
        </div>
    </div>
</nav>
