@foreach ($films as $film)
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $film[0]->titre }}</div>
            <p class="text-gray-700 text-base">
                {{ $film[0]->resum }}
            </p>
        </div>
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Duration: {{ $film[0]->duree_min }}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Year: {{ $film[0]->annee_prod }}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Genre</span>
        </div>
        <a href="/MVC_PiePHP/cinema/removeHistory/{{ $film["historyId"] }}">
            <button class="bg-orange-600 hover:bg-orange-400 text-white">Remove from history</button>
        </a>
    </div>
@endforeach
