@extends('layouts.loja_livros')

@section('content')

    <h1 class="section-title">Contactos</h1>

    <p class="contact-intro">

        Tens alguma dúvida ou sugestão?
        Entra em contacto connosco.

    </p>

    @if(session('success'))

        <p class="success">
            {{ session('success') }}
        </p>

    @endif

    <div class="contact-grid">

        <div class="contact-info">

            <h2>Informações de contacto</h2>

            <p>
                Estamos disponíveis para esclarecer
                dúvidas sobre os nossos livros.
            </p>

            <div class="contact-item">

                <h3>Email</h3>

                <p>{{ config('mail.from.address') }}</p>

            </div>

            <div class="contact-item">

                <h3>Localização</h3>

                <p>Madeira, Portugal</p>

            </div>

            <div class="contact-item">

                <h3>Sobre a BookStore</h3>

                <p>
                    Loja de livros desenvolvida no âmbito
                    do projeto académico de Aplicações
                    Centradas em Redes.
                </p>

            </div>

        </div>

        <div class="contact-form">

            <h2>Envia-nos uma mensagem</h2>

            <form method="POST"
                  action="{{ route('contacts.send') }}">

                @csrf

                <div class="contact-field">

                    <label for="name">Nome</label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                           required>

                    @error('name')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

                <div class="contact-field">

                    <label for="email">Email</label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                           required>

                    @error('email')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

                <div class="contact-field">

                    <label for="subject">Assunto</label>

                    <input type="text"
                           id="subject"
                           name="subject"
                           value="{{ old('subject') }}"
                           required>

                    @error('subject')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

                <div class="contact-field">

                    <label for="message">Mensagem</label>

                    <textarea id="message"
                              name="message"
                              rows="6"
                              required>{{ old('message') }}</textarea>

                    @error('message')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

                <button type="submit" class="btn">

                    Enviar mensagem

                </button>

            </form>

        </div>

    </div>

@endsection
