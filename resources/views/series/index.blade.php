
<x-layout title="{{  __('messages.app_name') }}" :mensagem-sucesso="$mensagemSucesso" >
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth
    <ul class="list-group">
        @foreach($series as $x)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <img src="{{asset('storage/' . $x->cover)}}"
                     width="150"
                     alt="Capa da série"
                     class="img-fluid">
                @auth<a href="{{ route('seasons.index', $x->id)}}">@endauth
                {{ $x->name }}
                    @auth</a>@endauth
                @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $x->id) }}" class="btn btn-primary btn-sm">
                    E
                </a>
                <form action="{{ route('series.destroy', $x->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    X
                </button>
                </form>
            </span>
                @endauth
            </li>
        @endforeach
    </ul>
</x-layout>
