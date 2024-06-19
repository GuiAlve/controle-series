
<!DOCTYPE html>
<html lang="pt-br">
@vite(['resources/sass/app.scss','resources/js/app.js'])
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route(('series.index')) }}">Home</a>

        @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-link">
                Sair
            </button>
        </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Entrar</a>
        @endguest
    </div>
</nav>
<div class="container">
<h1>{{ $title }}</h1>

    @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
    @endisset

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

{{ $slot }}
</div>

</body>
</html>
