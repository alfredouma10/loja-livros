@extends('layouts.loja_livros')

@section('content')

<div class="category-catalog">

    <!-- CABECALHO -->

    <div class="category-catalog-heading">

        <span>O NOSSO CATÁLOGO</span>

        <h1>Categorias de livros</h1>

        <p>
            Explora os diferentes géneros literários
            e descobre histórias para todos os gostos.
        </p>

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

    <!-- CONTADOR E ADICIONAR -->

    <div class="category-catalog-toolbar">

        <p>

            <strong>{{ $categories->count() }}</strong>
            categorias disponíveis

        </p>

        @auth

            @if(Auth::user()->isAdmin)

                <a href="{{ route('categories.create') }}"
                   class="catalog-button">

                    + Adicionar categoria

                </a>

            @endif

        @endauth

    </div>

    <!-- CATEGORIAS -->

    <div class="category-catalog-grid">

        @forelse($categories as $category)

            <article class="category-catalog-card">

                <a href="{{ url('/catalogo/categorias/' . $category->id) }}"
                   class="category-catalog-image">

                    <img src="{{ asset($category->img) }}"
                         alt="{{ $category->name }}">

                </a>

                <div class="category-catalog-content">

                    <h2>{{ $category->name }}</h2>

                    <p>{{ $category->description }}</p>

                    <div class="category-catalog-actions">

                        <a href="{{ url('/catalogo/categorias/' . $category->id) }}"
                           class="catalog-button catalog-details">

                            Explorar categoria &rarr;

                        </a>

                        @auth

                            @if(Auth::user()->isAdmin)

                                <div class="catalog-admin-actions">

                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="catalog-edit">

                                        Editar

                                    </a>

                                    <form method="POST"
                                          action="{{ route('categories.destroy', $category->id) }}"
                                          onsubmit="return confirm('Tens a certeza que pretendes eliminar esta categoria?');">

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

                <h2>Não existem categorias</h2>

                <p>
                    Ainda não existem categorias disponíveis.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection
