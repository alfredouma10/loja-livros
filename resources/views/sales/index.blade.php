@extends('layouts.loja_livros')

@section('content')

    <h1 class="section-title">As minhas compras</h1>

    @if(session('success'))

        <p class="success">
            {{ session('success') }}
        </p>

    @endif

    @if(count($sales) == 0)

        <div class="empty-message">

            <h2>Ainda não efetuaste nenhuma compra.</h2>

            <p>Explora os nossos livros e encontra a tua próxima leitura.</p>

            <a href="{{ route('books.index') }}" class="btn">

                Explorar livros

            </a>

        </div>

    @else

        <div class="sales-summary">

            <h3>Histórico de compras</h3>

            <p>Total de compras: {{ count($sales) }}</p>

        </div>

        <div class="sales-list">

            @foreach($sales as $sale)

                <div class="sale-card">

                    <div class="sale-image">

                        <img src="{{ asset($sale->book->img) }}"
                             alt="{{ $sale->book->title }}">

                    </div>

                    <div class="sale-info">

                        <span class="sale-status">

                            Compra concluída

                        </span>

                        <h3>{{ $sale->book->title }}</h3>

                        <p>{{ $sale->book->author }}</p>

                        <p>
                            <strong>Data da compra:</strong>
                            {{ $sale->date }}
                        </p>

                        <p>
                            <strong>Número da compra:</strong>
                            #{{ $sale->id }}
                        </p>

                    </div>

                    <div class="sale-actions">

                        <h3 class="sale-price">

                            {{ number_format($sale->book->price, 2, ',', '.') }} €

                        </h3>

                        <a href="{{ route('books.show', $sale->book->id) }}"
                           class="btn">

                            Ver livro

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

    <div class="form-buttons">

        <a href="{{ route('dashboard') }}" class="btn">

            Painel de Controlo

        </a>

        <a href="{{ route('books.index') }}" class="btn">

            Continuar a explorar

        </a>

    </div>

@endsection
