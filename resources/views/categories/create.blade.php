@extends('layouts.loja_livros')

@section('content')

@php
    $editing = isset($category);
@endphp

<div class="book-editor">

    <div class="book-editor-heading">

        <span class="book-editor-label">
            GESTÃO DO CATÁLOGO
        </span>

        <h1>
            {{ $editing ? 'Editar categoria' : 'Adicionar categoria' }}
        </h1>

        <p>
            {{ $editing
                ? 'Atualiza as informações da categoria.'
                : 'Adiciona uma nova categoria ao catálogo da livraria.' }}
        </p>

    </div>

    @if($errors->any())
        <div class="category-form-errors">

            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach

        </div>
    @endif

    <form method="POST"
          action="{{ $editing
              ? route('categories.update', $category->id)
              : route('categories.store') }}">

        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div class="category-editor-card">

            <div class="category-editor-grid">

                <!-- Informações da categoria -->

                <div class="category-editor-fields">

                    <h2>Informações da categoria</h2>

                    <p class="category-editor-help">
                        Preenche os dados apresentados no catálogo.
                    </p>

                    <div class="category-editor-field">

                        <label for="name">
                            Nome da categoria
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               placeholder="Ex.: Aventura"
                               value="{{ old('name', $category->name ?? '') }}"
                               required>

                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="category-editor-field">

                        <label for="description">
                            Descrição
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="6"
                                  placeholder="Escreve uma descrição da categoria..."
                                  required>{{ old('description', $category->description ?? '') }}</textarea>

                        @error('description')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <!-- Imagem da categoria -->

                <div class="category-editor-image">

                    <h2>Imagem da categoria</h2>

                    <p class="category-editor-help">
                        Escolhe a imagem apresentada no catálogo.
                    </p>

                    <div class="category-editor-upload">

                        <input type="hidden"
                               name="img"
                               id="img"
                               value="{{ old('img', $category->img ?? '') }}">

                        <img id="preview"
                             src="{{ old('img', $category->img ?? '') ? asset(old('img', $category->img ?? '')) : '' }}"
                             alt="Imagem da categoria"
                             style="{{ old('img', $category->img ?? '') ? '' : 'display:none;' }}">

                        <div id="image-placeholder"
                             style="{{ old('img', $category->img ?? '') ? 'display:none;' : '' }}">

                            <svg width="48"
                                 height="48"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.3">

                                <rect x="3" y="3"
                                      width="18" height="18"
                                      rx="3"/>

                                <circle cx="8.5"
                                        cy="8.5"
                                        r="1.5"/>

                                <path d="m21 15-5-5L5 21"/>

                            </svg>

                            <h3>Imagem da categoria</h3>

                            <p>Nenhuma imagem selecionada</p>

                        </div>

                        <button type="button"
                                id="upload_widget"
                                class="catalog-button catalog-primary">

                            {{ $editing
                                ? 'Alterar imagem'
                                : 'Escolher imagem' }}

                        </button>

                    </div>

                    <p class="category-image-note">
                        Formatos recomendados: JPG, PNG ou WEBP.
                    </p>

                    @error('img')
                        <small class="category-field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>

            <div class="category-editor-actions">

                <a href="{{ url('/catalogo/categorias') }}"
                   class="catalog-button catalog-secondary">
                    Cancelar
                </a>

                <button type="submit"
                        class="catalog-button catalog-primary">

                    {{ $editing
                        ? 'Guardar alterações'
                        : 'Adicionar categoria' }}

                </button>

            </div>

        </div>

    </form>

</div>

<!-- Biblioteca do Cloudinary -->

<script src="https://upload-widget.cloudinary.com/global/all.js"></script>

<!-- Widget de upload -->

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const uploadButton = document.getElementById('upload_widget');

        let categoryWidget = null;

        uploadButton.addEventListener('click', function (event) {

            event.preventDefault();

            if (typeof window.cloudinary === 'undefined') {

                alert('Não foi possível carregar o Cloudinary.');

                return;

            }

            if (categoryWidget === null) {

                categoryWidget = window.cloudinary.createUploadWidget({

                    cloudName: 'isgxcxtc',

                    uploadPreset: 'lojalivros_preset',

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

                        document.getElementById('preview').src =
                            result.info.secure_url;

                        document.getElementById('preview').style.display =
                            'block';

                        document.getElementById('image-placeholder').style.display =
                            'none';

                        uploadButton.textContent = 'Alterar imagem';

                    }

                });

            }

            categoryWidget.open();

        });

    });

</script>

@endsection
