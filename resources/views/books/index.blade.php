@extends('layouts.loja_livros')

@section('content')

<div class="catalog-page">

    <!-- CABECALHO -->

    <section class="catalog-heading">

        <span class="catalog-label">
            DESCOBRE A NOSSA COLEÇÃO
        </span>

        <h1>Os nossos livros</h1>

        <p>
            Encontra histórias que merecem
            um lugar na tua estante.
        </p>

    </section>


    <!-- PESQUISA E ORDENACAO -->

    <section class="catalog-filters">

        <form method="GET"
              action="{{ url()->current() }}"
              class="catalog-search-form">

            <div class="catalog-search">

                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Pesquisar por título ou autor...">

                <button type="submit"
                        class="catalog-button">

                    Pesquisar

                </button>

                <a href="{{ url()->current() }}"
                   class="catalog-clear">

                    Limpar

                </a>

            </div>

            <div class="catalog-sort">

                <label for="order">
                    Ordenar por:
                </label>

                <select name="order"
                        id="order"
                        onchange="this.form.submit()">

                    <option value="title_asc"
                        {{ ($order ?? 'title_asc') == 'title_asc' ? 'selected' : '' }}>

                        Título A-Z

                    </option>

                    <option value="title_desc"
                        {{ ($order ?? '') == 'title_desc' ? 'selected' : '' }}>

                        Título Z-A

                    </option>

                    <option value="price_asc"
                        {{ ($order ?? '') == 'price_asc' ? 'selected' : '' }}>

                        Preço mais baixo

                    </option>

                    <option value="price_desc"
                        {{ ($order ?? '') == 'price_desc' ? 'selected' : '' }}>

                        Preço mais alto

                    </option>

                </select>

            </div>

        </form>

    </section>


    <!-- FILTROS DAS CATEGORIAS -->

    <div class="catalog-categories">

        <a href="{{ route('books.index', [
                'search' => $search ?? '',
                'order' => $order ?? 'title_asc'
            ]) }}"
           class="catalog-category
           {{ $activeCategory == 0 ? 'active' : '' }}">

            Todos os livros

        </a>

        @foreach($categories as $category)

            <a href="{{ route('categories.books', [
                    'id' => $category->id,
                    'search' => $search ?? '',
                    'order' => $order ?? 'title_asc'
                ]) }}"
               class="catalog-category
               {{ $activeCategory == $category->id ? 'active' : '' }}">

                {{ $category->name }}

            </a>

        @endforeach

    </div>


    <!-- MENSAGENS -->

    @if(session('success'))

        <div class="catalog-message success">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="catalog-message error">

            {{ session('error') }}

        </div>

    @endif


    <!-- RESULTADOS E ADICIONAR LIVRO -->

    <div class="catalog-toolbar">

        <p>
            <strong>{{ $books->total() }}</strong>
            livros encontrados
        </p>

        @auth

            @if(Auth::user()->isAdmin)

                <a href="{{ route('books.create') }}"
                   class="catalog-button">

                    + Adicionar livro

                </a>

            @endif

        @endauth

    </div>


    <!-- LISTAGEM DOS LIVROS -->

    <div class="catalog-grid">

        @forelse($books as $book)

            <article class="catalog-card">

                <!-- IMAGEM -->

                <a href="{{ route('books.show', $book->id) }}"
                   class="catalog-image">

                    <img src="{{ asset($book->img) }}"
                         alt="{{ $book->title }}"
                         loading="lazy">

                </a>


                <!-- INFORMACOES -->

                <div class="catalog-card-content">

                    <span class="catalog-book-category">

                        {{ $book->category->name ?? 'Sem categoria' }}

                    </span>

                    <h2>{{ $book->title }}</h2>

                    <p class="catalog-author">

                        {{ $book->author }}

                    </p>


                    <!-- PRECO E STOCK -->

                    <div class="catalog-price-row">

                        <span class="catalog-price">

                            {{ number_format($book->price, 2, ',', '.') }} €

                        </span>

                        @if($book->stock > 0)

                            <span class="catalog-stock available">

                                Em stock

                            </span>

                        @else

                            <span class="catalog-stock unavailable">

                                Esgotado

                            </span>

                        @endif

                    </div>


                    <!-- BOTOES -->

                    <div class="catalog-actions">

                        <a href="{{ route('books.show', $book->id) }}"
                           class="catalog-button catalog-details">

                            Ver detalhes &rarr;

                        </a>


                        <!-- ADMINISTRADOR -->

                        @auth

                            @if(Auth::user()->isAdmin)

                                <div class="catalog-admin-actions">

                                    <a href="{{ route('books.edit', $book->id) }}"
                                       class="catalog-edit">

                                        Editar

                                    </a>

                                    <form method="POST"
                                          action="{{ route('books.destroy', $book->id) }}"
                                          onsubmit="return confirm('Tens a certeza que pretendes eliminar este livro?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="catalog-delete">

                                            Eliminar

                                        </button>

                                    </form>

                                </div>

                            @endif

                        @endauth

                    </div>

                </div>

            </article>

        @empty

            <div class="catalog-empty">

                <h2>Nenhum livro encontrado</h2>

                <p>
                    Experimenta pesquisar outro título
                    ou selecionar uma categoria diferente.
                </p>

                <a href="{{ route('books.index') }}"
                   class="catalog-button">

                    Ver todos os livros

                </a>

            </div>

        @endforelse

    </div>


    <!-- PAGINACAO -->

    @if($books->hasPages())

        <div class="catalog-pagination">

            @if($books->onFirstPage())

                <span class="catalog-page-disabled">
                    &larr; Anterior
                </span>

            @else

                <a href="{{ $books->previousPageUrl() }}">
                    &larr; Anterior
                </a>

            @endif

            <span class="catalog-page-number">

                Página {{ $books->currentPage() }}
                de {{ $books->lastPage() }}

            </span>

            @if($books->hasMorePages())

                <a href="{{ $books->nextPageUrl() }}">
                    Seguinte &rarr;
                </a>

            @else

                <span class="catalog-page-disabled">
                    Seguinte &rarr;
                </span>

            @endif

        </div>

    @endif

</div>

@endsection
