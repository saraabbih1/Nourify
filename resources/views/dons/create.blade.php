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
                        <select id="don-type" name="type" class="field">
                            <option value="">Selectionner le type</option>
                            <option value="argent" @selected(old('type') === 'argent')>Argent</option>
                            <option value="nourriture" @selected(old('type') === 'nourriture')>Nourriture</option>
                            <option value="vetements" @selected(old('type') === 'vetements')>Vetements</option>
                            <option value="autre" @selected(old('type') === 'autre')>Autre</option>
                        </select>
                    </div>

                    <div id="money-fields">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Montant (MAD)</label>
                        <input type="number" step="0.01" name="montant" class="field" value="{{ old('montant') }}">
                    </div>

                    <div id="in-kind-fields" class="hidden space-y-4">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Quantite</label>
                            <input type="number" step="0.01" name="quantite" class="field" value="{{ old('quantite') }}" placeholder="Ex: 10">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Unite</label>
                            <input type="text" name="unite" class="field" value="{{ old('unite') }}" placeholder="kg, piece, carton...">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Description</label>
                            <textarea name="description" class="field" rows="3" placeholder="Ex: Veste hiver, riz, conserves...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="btn-primary">Envoyer</button>
                        <a href="{{ route('dons.index') }}" class="btn-muted">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const typeSelect = document.getElementById('don-type');
            const moneyFields = document.getElementById('money-fields');
            const inKindFields = document.getElementById('in-kind-fields');

            function toggleFields() {
                const type = typeSelect.value;
                const isMoney = type === 'argent' || type === '';

                moneyFields.classList.toggle('hidden', !isMoney);
                inKindFields.classList.toggle('hidden', isMoney);
            }

            typeSelect.addEventListener('change', toggleFields);
            toggleFields();
        })();
    </script>
</x-app-layout>
