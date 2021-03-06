<h3 class='text-red-400 font-bold'>{{ $error }}</h3>
<h3 class='text-green-400 font-bold'>{{ $message }}</h3>
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <form action="/MVC_PiePHP/cinema/filmSearch" method="post">
                    <input id="film" name="film" class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10"
                           type="text" placeholder="Rechercher...">
                    <button class="bg-orange-500 hover:bg-orange-400  text-white font-bold rounded-full" type="submit">
                        Go
                    </button>
                </form>
                <form action="/MVC_PiePHP/cinema/genreSearch" method="post">
                    <select id="genre" name="genre"
                            class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
                        <option value="">Genres</option>
                        @foreach ($genres as $value)
                            <option value="{{ $value->id_genre }}">{{ ucfirst($value->nom) }}</option>
                        @endforeach
                    </select>
                    <button class="bg-orange-500 hover:bg-orange-400  text-white font-bold rounded-full" type="submit">
                        Go
                    </button>
                </form>
                <select id="distrib"
                        class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
                    <option value="">Distributeurs</option>
                    @foreach ($distributeurs as $value)
                        <option value="{{ $value->id_distrib }}">{{ ucfirst($value->nom) }}</option>
                    @endforeach
                </select>
                <select id="taille"
                        class="border border-red-700 rounded-full text-red-600 h-10 pl-5 pr-10 bg-white hover:border-red-800 focus:outline-none appearance-none">
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