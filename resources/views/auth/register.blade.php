@extends('layouts.loja_livros')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="store-auth-page">

    <div class="store-auth-heading">

        <span class="store-auth-label">
            JUNTA-TE À BOOKSTORE
        </span>

        <h1>A tua próxima história começa aqui</h1>

        <p>
            Cria uma conta e descobre tudo o que a nossa livraria tem para oferecer.
        </p>

    </div>

    <div class="store-auth-card store-auth-register">

        <div class="store-auth-intro">

            <div class="store-auth-icon">

                <svg width="30"
                     height="30"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.5">

                    <circle cx="9" cy="7" r="4"/>

                    <path d="M2 21v-2a7 7 0 0 1 14 0v2"/>

                    <path d="M19 8v6M16 11h6"/>

                </svg>

            </div>

            <h2>Criar uma conta</h2>

            <p>Preenche os teus dados para te registares.</p>

        </div>

        @if($errors->any())

            <div class="store-auth-errors">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        <form method="POST"
              action="{{ route('register') }}"
              class="store-auth-form">

            @csrf

            <!-- NOME -->

            <div class="store-auth-field">

                <label for="name">
                    Nome completo
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Introduz o teu nome"
                       autocomplete="name"
                       required
                       autofocus>

            </div>

            <!-- EMAIL -->

            <div class="store-auth-field">

                <label for="email">
                    Endereço de email
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="exemplo@email.com"
                       autocomplete="username"
                       required>

            </div>

            <!-- SENHA -->

            <div class="store-auth-field">

                <label for="password">
                    Palavra-passe
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Cria uma palavra-passe"
                       autocomplete="new-password"
                       minlength="8"
                       required>

                <small>
                    Utiliza pelo menos 8 caracteres.
                </small>

            </div>

            <!-- CONFIRMAR SENHA -->

            <div class="store-auth-field">

                <label for="password_confirmation">
                    Confirmar palavra-passe
                </label>

                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Repete a tua palavra-passe"
                       autocomplete="new-password"
                       required>

            </div>

            <!-- REGISTAR -->

            <button type="submit"
                    class="store-auth-submit">

                Criar conta

            </button>

        </form>

        <div class="store-auth-divider">

            <span>Já tens uma conta?</span>

        </div>

        <a href="{{ route('login') }}"
           class="store-auth-secondary">

            Entrar na minha conta

        </a>

    </div>

    <a href="{{ url('/') }}"
       class="store-auth-back">

        &larr; Voltar à livraria

    </a>

</div>

@endsection
