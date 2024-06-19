<x-layout title="Nova Série">

    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row-mb-3">
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text"
                       autofocus
                       id="name"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}">
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

            <div class="row mb-3">
                <div class="col-12">
                    <label for="cover" class="form-label">Capa</label>
                    <input type="file"
                           id="cover"
                           name="cover"
                           class="form-control"
                           accept="image/gif, image/jpeg, image/png">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>

    </form>

</x-layout>
