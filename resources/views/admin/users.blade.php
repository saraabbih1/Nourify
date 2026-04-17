<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Gestion Users</h1>
                <p class="mt-1 text-sm text-slate-500">Liste des utilisateurs de la plateforme.</p>
            </div>

            <div class="table-shell">
                <table class="w-full">
                    <thead class="table-head">
                    <tr>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="table-cell font-medium">{{ $user->name }}</td>
                            <td class="table-cell">{{ $user->email }}</td>
                            <td class="table-cell">{{ $user->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="table-cell text-center text-slate-500">Aucun user trouve.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
