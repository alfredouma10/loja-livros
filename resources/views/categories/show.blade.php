@extends('layouts.loja_livros')

@section('content')

<div class="category-detail-page">

    <!-- Navegação -->

    <div class="category-detail-breadcrumb">

        <a href="{{ url('/') }}">Início</a>

        <span>/</span>

        <a href="{{ route('categories.public') }}">
            Categorias
        </a>

        <span>/</span>

        <span>{{ $category->name }}</span>

    </div>

    <!-- Mensagens -->

    @if(session('success'))
        <div class="category-detail-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="category-detail-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Informações da categoria -->

    <div class="category-detail-banner">

        <div class="category-detail-image">

            <img src="{{ asset($category->img) }}"
                 alt="{{ $category->name }}">

        </div>

        <div class="category-detail-content">

            <span class="category-detail-label">
                O NOSSO CATÁLOGO
            </span>

            <h1>{{ $category->name }}</h1>

            <p>{{ $category->description }}</p>

            <span class="category-detail-count">

                {{ $category->books->count() }}
                livros no catálogo

            </span>

            <div class="category-detail-actions">

                <a href="{{ route('categories.public') }}"
                   class="category-detail-btn secondary">

                    Voltar às categorias

                </a>

                @auth

                    @if(Auth::user()->isAdmin)

                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="category-detail-btn primary">

                            Editar categoria

                        </a>

                        <form action="{{ route('categories.destroy', $category->id) }}"
                              method="POST"
                              onsubmit="return confirm('Pretendes eliminar esta categoria?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="category-detail-btn danger">

                                Eliminar

                            </button>

                        </form>

                    @endif

                @endauth

            </div>

        </div>

    </div>

    <!-- Livros da categoria -->

    <div class="category-detail-heading">

        <span>EXPLORA A NOSSA COLEÇÃO</span>

        <h2>Livros de {{ $category->name }}</h2>

        <p>
            Descobre os livros disponíveis nesta categoria.
        </p>

    </div>

    <div class="category-detail-grid">

        @forelse($category->books as $book)

            <div class="category-detail-book">

                <div class="category-detail-book-image">

                    <img src="{{ asset($book->img) }}"
                         alt="{{ $book->title }}">

                </div>

                <div class="category-detail-book-content">

                    <h3>{{ $book->title }}</h3>

                    <p>{{ $book->author }}</p>

                    @if($book->stock > 0)

                        <span class="category-detail-stock available">
                            Em stock
                        </span>

                    @else

                        <span class="category-detail-stock unavailable">
                            Esgotado
                        </span>

                    @endif

                    <div class="category-detail-book-bottom">

                        <strong>
                            {{ number_format($book->price, 2, ',', '.') }} €
                        </strong>

                        <a href="{{ route('books.show', $book->id) }}"
                           class="category-detail-btn primary">

                            Ver detalhes

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="category-detail-empty">

                <h3>Ainda não existem livros nesta categoria.</h3>

                <p>Explora os restantes livros da nossa livraria.</p>

                <a href="{{ route('books.index') }}"
                   class="category-detail-btn primary">

                    Explorar livros

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection
