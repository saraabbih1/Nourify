<x-app-layout>

    <div class="flex min-h-screen bg-gray-100">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg p-5 hidden md:block">
            <h2 class="text-xl font-bold mb-6 text-blue-600">Nourify</h2>

            <nav class="space-y-3">
                <a href="{{ route('dashboard', ['view' => 'home']) }}"
                    class="block px-4 py-2 rounded bg-blue-100 text-blue-600">Dashboard</a>
                <a href="{{ route('dashboard', ['view' => 'campaigns']) }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">Campagnes</a>
                <a href="{{ route('dashboard', ['view' => 'donations']) }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">Dons</a>
                <a href="{{ route('dashboard', ['view' => 'notifications']) }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">Notifications</a>
                <a href="{{ route('dashboard', ['view' => 'create']) }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">Créer</a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 p-6">

            <!-- TOPBAR -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 bg-blue-500 rounded-full"></div>
                </div>
            </div>

            <!--  HOME  -->
            @if($view == 'home')

                <div class="grid md:grid-cols-3 gap-6 mb-6">

                    <div class="bg-white p-5 rounded-xl shadow">
                        <p class="text-gray-500">Campagnes</p>
                        <h2 class="text-2xl font-bold">{{ $campaigns->count() }}</h2>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow">
                        <p class="text-gray-500">Dons</p>
                        <h2 class="text-2xl font-bold">{{ $donations->count() }}</h2>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow">
                        <p class="text-gray-500">Total (MAD)</p>
                        <h2 class="text-2xl font-bold">{{ $donations->sum('montant') }}</h2>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6 mb-6">

                        <div class="bg-white p-5 rounded shadow">
                            <p>Total dons</p>
                            <h2>{{ $totalAmount }} MAD</h2>
                        </div>

                        <div class="bg-white p-5 rounded shadow">
                            <p>Nombre de dons</p>
                            <h2>{{ $totalDons }}</h2>
                        </div>

                        <div class="bg-white p-5 rounded shadow">
                            <p>Campagnes</p>
                            <h2>{{ $totalCampaigns }}</h2>
                        </div>

                    </div>

                </div>


            @endif

            <!--  CAMPAIGNS  -->
            @if($view == 'campaigns')

                <div class="bg-white p-6 rounded-xl shadow">

                    <div class="flex justify-between mb-4">
                        <h2 class="font-bold">Campagnes</h2>

                        <a href="{{ route('dashboard', ['view' => 'create']) }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                            + Créer
                        </a>
                    </div>

                    @foreach($campaigns as $c)
                        <div class="border p-4 rounded mb-4">

                            <h3 class="font-bold">{{ $c->titre }}</h3>
                            <p class="text-sm text-gray-500">{{ $c->description }}</p>
                            <p>{{ $c->objectif }} MAD</p>

                            <!-- Progress -->
                            <div class="w-full bg-gray-200 h-2 rounded mt-2">
                                <div class="bg-blue-600 h-2 rounded" style="width: 50%"></div>
                            </div>

                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('dashboard', ['view' => 'edit', 'id' => $c->id]) }}"
                                    class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</a>

                                <form method="POST" action="{{ route('campagnes.destroy', $c->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 px-3 py-1 rounded text-white">Delete</button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                </div>

            @endif

            <!--  DONATIONS  -->
            @if($view == 'donations')

                <div class="bg-white p-6 rounded-xl shadow">

                    <h2 class="font-bold mb-4">Dons</h2>

                    @foreach($donations as $d)
                        <div class="border p-4 rounded mb-3 flex justify-between items-center">

                            <div>
                                <p class="font-bold">{{ $d->montant }} MAD</p>
                                <p class="text-sm text-gray-500">{{ $d->statut }}</p>
                            </div>

                            <div class="flex gap-2">

                                <form method="POST" action="#">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1 rounded">Accept</button>
                                </form>

                                <form method="POST" action="#">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">Refuse</button>
                                </form>

                            </div>

                        </div>
                    @endforeach

                </div>

            @endif

            <!--  NOTIFICATIONS  -->
            @if($view == 'notifications')

                <div class="bg-white p-6 rounded-xl shadow">

                    <h2 class="font-bold mb-4">Notifications</h2>

                    @foreach($notifications as $n)
                        <div class="border p-3 rounded mb-2">
                            <p>{{ $n->message }}</p>
                        </div>
                    @endforeach

                </div>

            @endif

            <!--  CREATE  -->
            @if($view == 'create')

                <div class="bg-white p-6 rounded-xl shadow max-w-md mx-auto">

                    <h2 class="font-bold mb-4">Créer Campagne</h2>

                    <form method="POST" action="{{ route('campagnes.store') }}">
                        @csrf

                        <input name="titre" class="w-full border p-2 mb-3 rounded" placeholder="Titre">
                        <textarea name="description" class="w-full border p-2 mb-3 rounded"></textarea>
                        <input name="objectif" type="number" class="w-full border p-2 mb-3 rounded">

                        <button class="bg-blue-600 text-white w-full py-2 rounded">Créer</button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>