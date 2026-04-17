<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-3xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Modifier la campagne</h1>
                <p class="mt-1 text-sm text-slate-500">Met a jour les informations de la campagne.</p>
            </div>

            <div class="surface-card">
                <form action="{{ route('campagnes.update', $campagne->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Titre</label>
                        <input type="text" name="titre" class="field" value="{{ old('titre', $campagne->titre) }}">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Description</label>
                        <textarea name="description" class="field" rows="4">{{ old('description', $campagne->description) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Objectif (MAD)</label>
                        <input type="number" name="objectif" class="field" value="{{ old('objectif', $campagne->objectif) }}">
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="btn-primary">Mettre a jour</button>
                        <a href="{{ route('campagnes.index') }}" class="btn-muted">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
