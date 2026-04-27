<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-7xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Gestion Users</h1>
                <p class="mt-1 text-sm text-slate-500">Liste des utilisateurs de la plateforme.</p>
            </div>

            @if(session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-shell">
                <table class="w-full">
                    <thead class="table-head">
                    <tr>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Gestion role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="table-cell font-medium">{{ $user->name }}</td>
                            <td class="table-cell">{{ $user->email }}</td>
                            <td class="table-cell">{{ $user->role?->name ?? 'n/a' }}</td>
                            <td class="table-cell">{{ $user->created_at }}</td>
                            <td class="table-cell">
                                <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex flex-wrap items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role_id" class="field max-w-[12rem]">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @selected($user->role_id === $role->id)>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-primary">Mettre a jour</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-cell text-center text-slate-500">Aucun user trouve.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
