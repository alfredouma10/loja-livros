@extends('layouts.loja_livros')

@section('content')

<div class="store-page">

    <section class="store-hero">

        <span class="store-subtitle">
            A TUA PRÓXIMA HISTÓRIA COMEÇA AQUI
        </span>

        <h1>Um mundo de histórias à tua espera.</h1>

        <p>
            Descobre novos livros, explora mundos incríveis
            e encontra a tua próxima leitura favorita.
        </p>

        <a href="{{ route('books.index') }}"
           class="store-button">

            Explorar livros &rarr;

        </a>

    </section>

    <section class="store-categories">

        <div class="store-section-heading">

            <span class="store-subtitle">
                ENCONTRA A TUA PRÓXIMA LEITURA
            </span>

            <h2>Explora as nossas categorias</h2>

            <p>
                Uma história para cada tipo de leitor.
            </p>

        </div>

        <div class="store-category-grid">

            @foreach($categories as $category)

                <article class="store-category-card">

                    <div class="store-category-image">

                        <img src="{{ asset($category->img) }}"
                             alt="{{ $category->name }}">

                    </div>

                    <div class="store-category-content">

                        <h3>{{ $category->name }}</h3>

                        <p>{{ $category->description }}</p>

                        <a href="{{ route('categories.show', $category->id) }}"
                           class="store-category-link">

                            Explorar categoria

                            <span>&rarr;</span>

                        </a>

                    </div>

                </article>

            @endforeach

        </div>

        <div class="store-section-bottom">

            <a href="{{ route('categories.public') }}"
               class="store-button-outline">

                Ver todas as categorias &rarr;

            </a>

        </div>

    </section>

</div>

@endsection
