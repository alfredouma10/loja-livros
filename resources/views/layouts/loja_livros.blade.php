<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>BookStore - Loja de Livros</title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}">

</head>

<body>

    <header>

        <h1>BookStore</h1>

        <p>A tua loja de livros</p>

        <div class="auth-buttons"
             style="display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    gap: 12px;
                    flex-wrap: wrap;">

            @auth

                <strong>
                    Olá, {{ Auth::user()->name }}
                </strong>

                <a href="{{ route('dashboard') }}"
                   class="btn">

                    Painel de Controlo

                </a>

                <form method="POST"
                      action="{{ route('logout') }}"
                      style="margin: 0;">

                    @csrf

                    <button type="submit" class="btn">
                        Sair
                    </button>

                </form>

            @else

                <a href="{{ route('login') }}"
                   class="btn">

                    Entrar

                </a>

                <a href="{{ route('register') }}"
                   class="btn">

                    Registar

                </a>

            @endauth

        </div>

    </header>

    <nav>

        <a href="{{ route('home') }}">
            Início
        </a>

        <a href="{{ route('books.index') }}">
            Livros
        </a>

        <a href="{{ route('categories.public') }}">
            Categorias
        </a>

        <a href="{{ route('contacts') }}">
            Contactos
        </a>

        @auth

            

        @endauth

    </nav>

    <main class="container">

        @if(request()->routeIs('books.index', 'categories.books'))

            @include('partials.featured')

        @endif

        @yield('content')

    </main>

    <footer>

        <p>BookStore © 2026 - Projeto ACR</p>

        <p>Todos os direitos reservados.</p>

    </footer>

</body>

</html>
