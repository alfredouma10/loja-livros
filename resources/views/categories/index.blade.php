@extends('layouts.loja_livros')

@section('content')

    <h1 class="section-title">Gerir categorias</h1>

    <div class="page-actions">

        <a href="{{ route('categories.create') }}"
           class="btn">

            + Adicionar categoria

        </a>

    </div>

    @if(session('error'))

        <p class="error">{{ session('error') }}</p>

    @endif

    <div class="category-list">

        @foreach($categories as $category)

            <div class="category-row">

                <img src="{{ $category->img }}"
                     alt="{{ $category->name }}">

                <div class="category-info">

                    <h3>{{ $category->name }}</h3>

                    <p>{{ $category->description }}</p>

                    <a href="{{ route('categories.books', $category->id) }}"
                       class="category-link">

                        Ver livros

                    </a>

                </div>

                <div class="category-actions">

                    <a href="{{ route('categories.edit', $category->id) }}"
                       class="btn btn-edit">

                        Editar

                    </a>

                    <form method="POST"
                          action="{{ route('categories.destroy', $category->id) }}"
                          onsubmit="return confirm('Pretendes eliminar esta categoria?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-delete">

                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

    <div class="form-buttons">

        <a href="{{ route('dashboard') }}" class="btn">

            Voltar ao painel de controlo

        </a>

    </div>

@endsection