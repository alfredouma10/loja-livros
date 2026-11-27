@extends('layouts.loja_livros')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="store-auth-page">

    <div class="store-auth-heading">

        <span class="store-auth-label">
            A TUA CONTA
        </span>

        <h1>Bem-vindo de volta</h1>

        <p>
            Entra na tua conta e continua a descobrir novas histórias.
        </p>

    </div>

    <div class="store-auth-card">

        <div class="store-auth-intro">

            <div class="store-auth-icon">

                <svg width="30"
                     height="30"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.5">

                    <circle cx="12" cy="8" r="4"/>

                    <path d="M4 21v-2a8 8 0 0 1 16 0v2"/>

                </svg>

            </div>

            <h2>Entrar na conta</h2>

            <p>Introduz os teus dados de acesso.</p>

        </div>

        <!-- MENSAGENS DE SUCESSO -->

        @if(session('status'))

            <div class="store-auth-success">
                {{ session('status') }}
            </div>

        @endif

        <!-- MENSAGENS DE ERRO -->

        @if($errors->any())

            <div class="store-auth-errors">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        <!-- FORMULARIO -->

        <form method="POST"
              action="{{ route('login') }}"
              class="store-auth-form">

            @csrf

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
                       required
                       autofocus>

            </div>

            <!-- PALAVRA-PASSE -->

            <div class="store-auth-field">

                <label for="password">
                    Palavra-passe
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Introduz a tua palavra-passe"
                       autocomplete="current-password"
                       required>

            </div>

            <!-- BOTAO ENTRAR -->

            <button type="submit"
                    class="store-auth-submit">

                Entrar na conta

            </button>

        </form>

        <!-- SEPARADOR -->

        <div class="store-auth-divider">

            <span>Ainda não tens conta?</span>

        </div>

        <!-- BOTAO REGISTAR -->

        <a href="{{ route('register') }}"
           class="store-auth-secondary">

            Criar uma conta

        </a>

    </div>

    <!-- VOLTAR A LIVRARIA -->

    <a href="{{ url('/') }}"
       class="store-auth-back">

        &larr; Voltar à livraria

    </a>

</div>

@endsection
