<x-mail::message>

    # Serie Criada

    {{ $series }} criada

    A serie {{ $series }} com {{ $seasonsQty }} temporadas e {{ $episodesPerSeason }} episodios foi criada com sucesso

    Acesse aqui:

<x-mail::button :url="route('seasons.index', $idSeries)">
    Ver série
</x-mail::button>

</x-mail::message>

