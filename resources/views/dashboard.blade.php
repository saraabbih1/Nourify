<x-app-layout>
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-emerald-600 tracking-tight">Nour<span class="text-blue-700">ify</span></span>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard', ['view' => 'overview'])" :active="$view == 'overview'">
                            {{ __('Tableau de bord') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard', ['view' => 'campaigns'])" :active="$view == 'campaigns'">
                            {{ __('Campagnes') }}
                        </x-nav-link>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="?view=notifications" class="text-gray-500 hover:text-emerald-600 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($view == 'overview')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-emerald-500">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Dons</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">45,200 <span class="text-sm font-normal">MAD</span></p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-blue-600">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Campagnes Actives</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $campaigns->count() }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-amber-500">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Bénéficiaires Aidés</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">128</p>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl p-6">
                
                @if($view == 'campaigns' || $view == 'overview')
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-blue-900 dark:text-blue-400">Campagnes de Solidarité</h3>
                        <a href="?view=create" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-all shadow-lg shadow-emerald-200 dark:shadow-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                            Nouvelle Campagne
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($campaigns as $campaign)
                            <div class="group bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                                <div class="h-3 w-full bg-emerald-500"></div> <div class="p-6">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 transition">{{ $campaign->title }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 line-clamp-2">{{ $campaign->description }}</p>
                                    
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-xs font-bold uppercase tracking-tighter">
                                            <span class="text-emerald-600">Objectif: {{ number_format($campaign->goal) }} MAD</span>
                                            <span class="text-gray-400">75%</span>
                                        </div>
                                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full shadow-sm" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <button class="w-full mt-6 py-2.5 rounded-lg border-2 border-emerald-600 text-emerald-600 font-bold text-sm hover:bg-emerald-600 hover:text-white transition-colors">
                                        Soutenir ce projet
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @elseif($view == 'create')
                    <div class="max-w-xl mx-auto">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Lancer une initiative</h3>
                            <p class="text-gray-500">Remplissez les détails pour commencer à collecter des dons.</p>
                        </div>
                        
                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <x-input-label for="title" :value="__('Nom de la campagne')" />
                                <x-text-input id="title" class="block mt-1 w-full bg-gray-50" type="text" name="title" placeholder="Ex: Panier Ramadanesque" required />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Histoire & Objectifs')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm" placeholder="Décrivez comment ces fonds aideront la communauté..."></textarea>
                            </div>

                            <div>
                                <x-input-label for="goal" :value="__('Montant recherché (MAD)')" />
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">DH</span>
                                    </div>
                                    <x-text-input id="goal" class="block w-full pl-10" type="number" name="goal" required />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-8 gap-4">
                                <a href="?view=campaigns" class="text-sm text-gray-500 hover:underline">Annuler</a>
                                <x-primary-button class="bg-blue-700 hover:bg-blue-800 px-8 py-3 rounded-xl">
                                    {{ __('Publier la Campagne') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                @elseif($view == 'notifications')
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Notifications</h3>
                        <button class="text-sm text-emerald-600 font-semibold hover:underline">Tout marquer comme lu</button>
                    </div>

                    <div class="space-y-4">
                        @forelse($notifications as $notif)
                            <div class="flex items-start p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl border border-transparent hover:border-emerald-200 transition">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="p-2 bg-emerald-100 text-emerald-600 rounded-full">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $notif->message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="ml-4 h-2 w-2 bg-emerald-500 rounded-full"></div>
                            </div>
                        @empty
                            <div class="py-20 text-center">
                                <p class="text-gray-400 italic">Aucune nouvelle notification pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                @endif
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-400 text-sm">© {{ date('Y') }} Nourify Platform — Solidarité marocaine digitale.</p>
            </div>
        </div>
    </div>
</x-app-layout>