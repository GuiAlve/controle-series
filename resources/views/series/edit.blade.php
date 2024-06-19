<x-layout title="Editar Série {{ $series->name }}">

    <form action="{{ route('series.update', $series->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3" class="form-label")>
            <label for="name" class="form-label">Nome:</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   value="{{ $series->name }}">
            </div>
        <div class="col-2">
            <label for="seasonQty" class="form-label">Nº Temporadas</label>
            <input type="number"
                   id="seasonsQty"
                   name="seasonsQty"
                   class="form-control"
                   value="{{ old('seasonsQty') }}">
        </div>

        <div class="col-2">
            <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
            <input type="number"
                   id="episodesPerSeason"
                   name="episodesPerSeason"
                   class="form-control"
                   value="{{ old('episodesPerSeason') }}">
        </div>

            <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

</x-layout>

