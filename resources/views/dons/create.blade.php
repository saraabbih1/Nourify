<x-app-layout>
    <div class="page-shell">
        <div class="mx-auto max-w-3xl space-y-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Proposer un don</h1>
                <p class="mt-1 text-sm text-slate-500">Formulaire de proposition de don.</p>
            </div>

            <div class="surface-card">
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('dons.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Montant (MAD)</label>
                        <input type="number" name="montant" class="field" value="{{ old('montant') }}">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Campagne</label>
                        <select name="campagne_id" class="field">
                            <option value="">Selectionner une campagne</option>
                            @foreach($campagnes as $campagne)
                                <option value="{{ $campagne->id }}" @selected(old('campagne_id') == $campagne->id)>
                                    {{ $campagne->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Type de don</label>
                        <select name="type" class="field">
                            <option value="">Selectionner le type</option>
                            <option value="argent" @selected(old('type') === 'argent')>Argent</option>
                            <option value="nourriture" @selected(old('type') === 'nourriture')>Nourriture</option>
                            <option value="vetements" @selected(old('type') === 'vetements')>Vetements</option>
                            <option value="autre" @selected(old('type') === 'autre')>Autre</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="btn-primary">Envoyer</button>
                        <a href="{{ route('dons.index') }}" class="btn-muted">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
