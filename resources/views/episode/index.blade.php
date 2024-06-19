<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episode as $episodes)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodes->number }}
                    <input type="checkbox"
                           name="episode[]"
                           value="{{ $episodes->id }}"
                           @if($episodes->watched) checked @endif
                    />
                </li>
            @endforeach
                <input type="hidden"
                       name="season[]"
                       value="{{ $episodes->seasons_id }}"
                />
        </ul>
        <button type="submit" class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
</x-layout>
