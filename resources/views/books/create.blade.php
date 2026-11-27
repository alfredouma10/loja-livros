@extends('layouts.loja_livros')

@section('content')

<div class="book-editor">

    <a href="{{ route('books.index') }}"
       class="editor-back">
        &larr; Voltar aos livros
    </a>

    <!-- CABECALHO -->

    <div class="editor-heading">

        <span>GESTÃO DO CATÁLOGO</span>

        <h1>
            {{ isset($book) ? 'Editar livro' : 'Adicionar livro' }}
        </h1>

        <p>
            {{ isset($book)
                ? 'Atualiza as informações do livro.'
                : 'Preenche os dados para adicionar um novo livro ao catálogo.' }}
        </p>

    </div>

    <!-- ERROS -->

    @if($errors->any())

        <div class="editor-errors">

            <strong>Verifica os seguintes campos:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORMULARIO -->

    <form method="POST"
          class="editor-form"
          action="{{ isset($book)
              ? route('books.update', $book->id)
              : route('books.store') }}">

        @csrf

        @if(isset($book))
            @method('PUT')
        @endif

        <!-- INFORMACOES -->

        <div class="editor-section">

            <div class="editor-section-heading">

                <h2>Informações do livro</h2>

                <p>Dados principais do livro.</p>

            </div>

            <div class="editor-grid">

                <!-- TITULO -->

                <div class="editor-field">

                    <label for="title">Título</label>

                    <input type="text"
                           id="title"
                           name="title"
                           placeholder="Ex.: O Hobbit"
                           value="{{ old('title', $book->title ?? '') }}"
                           required>

                </div>

                <!-- AUTOR -->

                <div class="editor-field">

                    <label for="author">Autor</label>

                    <input type="text"
                           id="author"
                           name="author"
                           placeholder="Ex.: J. R. R. Tolkien"
                           value="{{ old('author', $book->author ?? '') }}"
                           required>

                </div>

                <!-- CATEGORIA -->

                <div class="editor-field">

                    <label for="category_id">Categoria</label>

                    <select name="category_id"
                            id="category_id"
                            required>

                        <option value="">
                            Selecionar categoria
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id', $book->category_id ?? '') == $category->id
                                    ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- ISBN -->

                <div class="editor-field">

                    <label for="isbn">ISBN</label>

                    <input type="text"
                           name="isbn"
                           id="isbn"
                           placeholder="Ex.: 9780000000000"
                           value="{{ old('isbn', $book->isbn ?? '') }}"
                           required>

                </div>

                <!-- PRECO -->

                <div class="editor-field">

                    <label for="price">Preço (€)</label>

                    <input type="number"
                           name="price"
                           id="price"
                           min="0"
                           step="0.01"
                           placeholder="0.00"
                           value="{{ old('price', $book->price ?? '') }}"
                           required>

                </div>

                <!-- STOCK -->

                <div class="editor-field">

                    <label for="stock">Stock</label>

                    <input type="number"
                           name="stock"
                           id="stock"
                           min="0"
                           placeholder="Quantidade disponível"
                           value="{{ old('stock', $book->stock ?? '') }}"
                           required>

                </div>

                <!-- ANO -->

                <div class="editor-field">

                    <label for="publication_year">
                        Ano de publicação
                    </label>

                    <input type="number"
                           name="publication_year"
                           id="publication_year"
                           min="1"
                           max="{{ date('Y') }}"
                           placeholder="Ex.: 2026"
                           value="{{ old('publication_year', $book->publication_year ?? '') }}"
                           required>

                </div>

                <!-- DESCRICAO -->

                <div class="editor-field editor-full">

                    <label for="description">Descrição</label>

                    <textarea name="description"
                              id="description"
                              rows="4"
                              placeholder="Escreve uma breve descrição do livro..."
                              required>{{ old('description', $book->description ?? '') }}</textarea>

                </div>

            </div>

        </div>

        <!-- IMAGEM CLOUDINARY -->

        <div class="editor-section">

            <div class="editor-section-heading">

                <h2>Capa do livro</h2>

                <p>Seleciona a imagem que será apresentada no catálogo.</p>

            </div>

            <input type="hidden"
                   name="img"
                   id="img"
                   value="{{ old('img', $book->img ?? '') }}">

            <div class="editor-upload">

                <img id="imagePreview"
                     class="editor-preview"
                     src="{{ old('img', $book->img ?? '') ? asset(old('img', $book->img ?? '')) : '' }}"
                     alt="Capa do livro"
                     style="{{ old('img', $book->img ?? '') ? '' : 'display:none;' }}">

                <div class="editor-upload-content">

                    <svg width="42"
                         height="42"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.5">

                        <rect x="3" y="3"
                              width="18" height="18"
                              rx="3"/>

                        <circle cx="8.5"
                                cy="8.5"
                                r="1.5"/>

                        <path d="M21 15l-5-5L5 21"/>

                    </svg>

                    <h3>Imagem da capa</h3>

                    <p>
                        Carrega uma imagem através do Cloudinary.
                    </p>

                    <button type="button"
                            id="uploadWidgetBtn"
                            class="editor-upload-button">

                        {{ old('img', $book->img ?? '')
                            ? 'Alterar imagem'
                            : 'Escolher imagem' }}

                    </button>

                    <span id="uploadStatus">

                        {{ old('img', $book->img ?? '')
                            ? 'Imagem selecionada'
                            : 'Nenhuma imagem selecionada' }}

                    </span>

                </div>

            </div>

            @error('img')

                <p class="editor-error-text">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- BOTOES -->

        <div class="editor-actions">

            <a href="{{ route('books.index') }}"
               class="editor-cancel">

                Cancelar

            </a>

            <button type="submit"
                    class="editor-save">

                {{ isset($book)
                    ? 'Guardar alterações'
                    : 'Guardar livro' }}

            </button>

        </div>

    </form>

</div>

<!-- BIBLIOTECA DO CLOUDINARY -->

<script src="https://upload-widget.cloudinary.com/global/all.js"></script>

<!-- WIDGET DE UPLOAD -->

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const uploadButton =
            document.getElementById('uploadWidgetBtn');

        let uploadWidget = null;

        uploadButton.addEventListener('click', function (event) {

            event.preventDefault();

            if (typeof window.cloudinary === 'undefined') {

                alert('Não foi possível carregar o Cloudinary.');

                return;

            }

            if (uploadWidget === null) {

                uploadWidget = window.cloudinary.createUploadWidget({

                    cloudName: 'isgxcxtc',

                    uploadPreset: 'lojalivros_preset',

                    folder: 'books',

                    multiple: false,

                    resourceType: 'image',

                    sources: ['local', 'url']

                }, function (error, result) {

                    if (error) {

                        console.error('Erro Cloudinary:', error);

                        alert('Não foi possível carregar a imagem.');

                        return;

                    }

                    if (result && result.event === 'success') {

                        document.getElementById('img').value =
                            result.info.secure_url;

                        document.getElementById('imagePreview').src =
                            result.info.secure_url;

                        document.getElementById('imagePreview').style.display =
                            'block';

                        document.getElementById('uploadStatus').textContent =
                            'Imagem carregada com sucesso!';

                        document.getElementById('uploadStatus').style.color =
                            '#39734b';

                        uploadButton.textContent =
                            'Alterar imagem';

                    }

                });

            }

            uploadWidget.open();

        });

    });

</script>

@endsection
