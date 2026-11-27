@extends('layouts.loja_livros')

@section('content')

<div class="book-show-page">

    <div class="book-show-breadcrumb">
        <a href="{{ url('/') }}">Início</a>
        <span>/</span>
        <a href="{{ route('books.index') }}">Livros</a>
        <span>/</span>
        <span>{{ $book->title }}</span>
    </div>

    @if(session('success'))
        <div class="book-show-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="book-show-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="book-show-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="book-show-card">

        <!-- Imagem do livro -->

        <div class="book-show-image">

            <span class="book-show-brand">BOOKSTORE</span>

            <img src="{{ asset($book->img) }}"
                 alt="{{ $book->title }}">

            <span class="book-show-image-text">
                Capa do livro
            </span>

        </div>

        <!-- Informações do livro -->

        <div class="book-show-content">

            <span class="book-show-category">
                {{ $category->name ?? 'Sem categoria' }}
            </span>

            <h1>{{ $book->title }}</h1>

            <p class="book-show-author">
                por {{ $book->author }}
            </p>

            <div class="book-show-price-area">

                <span class="book-show-price">
                    {{ number_format($book->price, 2, ',', '.') }} €
                </span>

                @if($book->stock > 0)

                    <span class="book-show-stock available">
                        {{ $book->stock }} unidades disponíveis
                    </span>

                @else

                    <span class="book-show-stock unavailable">
                        Esgotado
                    </span>

                @endif

            </div>

            <div class="book-show-description">

                <h2>Sobre o livro</h2>

                <p>{{ $book->description }}</p>

            </div>

            <div class="book-show-information">

                <div class="book-show-info-item">
                    <span>Autor</span>
                    <strong>{{ $book->author }}</strong>
                </div>

                <div class="book-show-info-item">
                    <span>Categoria</span>
                    <strong>
                        {{ $category->name ?? 'Sem categoria' }}
                    </strong>
                </div>

                <div class="book-show-info-item">
                    <span>ISBN</span>
                    <strong>{{ $book->isbn }}</strong>
                </div>

                <div class="book-show-info-item">
                    <span>Ano de publicação</span>
                    <strong>{{ $book->publication_year }}</strong>
                </div>

            </div>

            <!-- Botões -->

            <div class="book-show-actions">

                <a href="{{ route('books.index') }}"
                   class="book-show-btn book-show-back">
                    Voltar aos livros
                </a>

                @auth

                    @if(Auth::user()->isAdmin)

                        <a href="{{ route('books.edit', $book->id) }}"
                           class="book-show-btn book-show-edit">
                            Editar livro
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}"
                              method="POST"
                              onsubmit="return confirm('Tens a certeza que pretendes eliminar este livro?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="book-show-btn book-show-delete">
                                Eliminar
                            </button>

                        </form>

                    @elseif($book->stock > 0)

                        <form action="{{ route('sales.store', $book->id) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="book-show-btn book-show-buy">
                                Comprar livro
                            </button>

                        </form>

                    @endif

                @else

                    @if($book->stock > 0)

                        <a href="{{ route('login') }}"
                           class="book-show-btn book-show-buy">
                            Entrar para comprar
                        </a>

                    @endif

                @endauth

            </div>

        </div>

    </div>

</div>

@endsection
