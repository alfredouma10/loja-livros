@php

    $featuredBook = \App\Models\Book::inRandomOrder()->first();

@endphp

@if($featuredBook)

    <section class="featured-book">

        <div class="featured-image">

            <a href="{{ route('books.show', $featuredBook->id) }}">

                <img src="{{ asset($featuredBook->img) }}"
                     alt="{{ $featuredBook->title }}">

            </a>

        </div>

        <div class="featured-info">

            <span class="featured-label">
                DESTAQUE DA LIVRARIA
            </span>

            <h2>{{ $featuredBook->title }}</h2>

            <p class="featured-author">
                {{ $featuredBook->author }}
            </p>

            <p class="featured-description">
                {{ $featuredBook->description }}
            </p>

            <h3 class="featured-price">

                {{ number_format($featuredBook->price, 2, ',', '.') }} €

            </h3>

            <a href="{{ route('books.show', $featuredBook->id) }}"
               class="btn">

                Descobrir livro

            </a>

        </div>

    </section>

@endif
