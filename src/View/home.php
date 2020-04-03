<div class="">
    <div class="">
        <div class="">
            <div class="">
                <input id="film" class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10" type="text" placeholder="Rechercher...">
                <select id="genre" class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
                    <option value="">Genres</option>
                    @foreach ($genres as $value)
                        <option value="{{ $value->id_genre }}">{{ ucfirst($value->nom) }}</option>
                    @endforeach
                </select>
                <select id="distrib" class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
                    <option value="">Distributeurs</option>
                    @foreach ($distributeurs as $value)
                    <option value="{{ $value->id_distrib }}">{{ ucfirst($value->nom) }}</option>
                    @endforeach
                </select>
                <select id="taille" class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
                    <option value="">Taille</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="">Tout</option>
                </select>
                <div class="" id="filmRes"></div>
            </div>
        </div>
    </div>
</div>