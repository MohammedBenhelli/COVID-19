@foreach ($films as $film)
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $film->titre }}</div>
            <p class="text-gray-700 text-base">
                {{ $film->resum }}
            </p>
        </div>
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Duration: {{ $film->duree_min }}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Year: {{ $film->annee_prod }}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Genre</span>
        </div>
        <a href="/MVC_PiePHP/cinema/addHistory/{{ $film->id_film }}">
            <button class="bg-orange-600 hover:bg-orange-400 text-white">Add history</button>
        </a>
    </div>
@endforeach
