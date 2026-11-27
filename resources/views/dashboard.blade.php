@extends('layouts.loja_livros')

@section('content')

<style>

    .dashboard-page {
        max-width: 1150px;
        margin: 0 auto;
        padding: 40px 24px 65px;
    }

    .dashboard-page * {
        box-sizing: border-box;
    }

    .dashboard-title {
        font-family: Georgia, serif;
        font-size: 40px;
        color: #35251b;
        text-align: center;
        margin: 0 0 35px;
    }

    .dashboard-card {
        background: #ffffff;
        border: 1px solid #e2d9cc;
        border-radius: 20px;
        padding: 45px;
        box-shadow: 0 8px 30px rgba(53, 37, 27, 0.05);
    }

    .dashboard-welcome {
        text-align: center;
        margin-bottom: 35px;
    }

    .dashboard-welcome h2 {
        font-family: Georgia, serif;
        font-size: 34px;
        color: #35251b;
        margin: 0 0 15px;
    }

    .dashboard-welcome p {
        color: #857665;
        font-size: 17px;
        margin: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
    }

    .dashboard-option {
        background: #f5f2ec;
        border: 1px solid #e2d9cc;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: 0.2s ease;
    }

    .dashboard-option:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(53, 37, 27, 0.07);
    }

    .dashboard-icon {
        width: 58px;
        height: 58px;
        background: #e8ddca;
        color: #967343;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .dashboard-option h3 {
        font-family: Georgia, serif;
        font-size: 27px;
        color: #35251b;
        margin: 0 0 12px;
    }

    .dashboard-option p {
        color: #857665;
        font-size: 15px;
        line-height: 1.6;
        margin: 0 0 25px;
    }

    .dashboard-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        margin-top: auto;
    }

    .dashboard-button {
        display: block;
        width: 100%;
        padding: 15px 20px;
        border-radius: 9px;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        font-size: 15px;
        transition: 0.2s ease;
    }

    .dashboard-primary {
        background: #503929;
        color: #ffffff;
    }

    .dashboard-primary:hover {
        background: #35251b;
        color: #ffffff;
    }

    .dashboard-secondary {
        background: #e8ddca;
        color: #503929;
    }

    .dashboard-secondary:hover {
        background: #dbccb4;
        color: #35251b;
    }

    .dashboard-bottom {
        display: flex;
        justify-content: center;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #eee6da;
    }

    .dashboard-bottom .dashboard-button {
        width: auto;
        min-width: 170px;
    }

    @media (max-width: 700px) {

        .dashboard-page {
            padding: 30px 15px 45px;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-card {
            padding: 25px 18px;
        }

        .dashboard-title {
            font-size: 32px;
        }

        .dashboard-welcome h2 {
            font-size: 27px;
        }

        .dashboard-option {
            padding: 25px 18px;
        }

    }

</style>

<div class="dashboard-page">

    

    <div class="dashboard-card">

        <!-- CABECALHO -->

        <div class="dashboard-welcome">

            <h2>
                Bem-vindo, {{ Auth::user()->name }}
            </h2>

            <p>
                Tipo de utilizador:
                {{ Auth::user()->isAdmin
                    ? 'Administrador'
                    : 'Cliente' }}
            </p>

        </div>

        <div class="dashboard-grid">

            @if(Auth::user()->isAdmin)

                <!-- ADMINISTRADOR: GESTAO DE LIVROS -->

                <div class="dashboard-option">

                    <div class="dashboard-icon">

                        <svg width="30"
                             height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.5">

                            <path d="M4 19V5a2 2 0 0 1 2-2h14v18H6a2 2 0 0 1 0-4h14"/>

                            <path d="M8 7h8"/>

                            <path d="M8 11h6"/>

                        </svg>

                    </div>

                    <h3>Gestão de livros</h3>

                    <p>
                        Consulta e gere os livros da loja.
                    </p>

                    <div class="dashboard-buttons">

                        <a href="{{ route('books.index') }}"
                           class="dashboard-button dashboard-primary">

                            Gerir livros

                        </a>

                        <a href="{{ route('books.create') }}"
                           class="dashboard-button dashboard-secondary">

                            Adicionar livro

                        </a>

                    </div>

                </div>

                <!-- ADMINISTRADOR: GESTAO DE CATEGORIAS -->

                <div class="dashboard-option">

                    <div class="dashboard-icon">

                        <svg width="30"
                             height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.5">

                            <rect x="3" y="3"
                                  width="7" height="7" rx="1"/>

                            <rect x="14" y="3"
                                  width="7" height="7" rx="1"/>

                            <rect x="3" y="14"
                                  width="7" height="7" rx="1"/>

                            <rect x="14" y="14"
                                  width="7" height="7" rx="1"/>

                        </svg>

                    </div>

                    <h3>Gestão de categorias</h3>

                    <p>
                        Organiza os livros por categoria.
                    </p>

                    <div class="dashboard-buttons">

                        <a href="{{ url('/catalogo/categorias') }}"
                           class="dashboard-button dashboard-primary">

                            Gerir categorias

                        </a>

                        <a href="{{ route('categories.create') }}"
                           class="dashboard-button dashboard-secondary">

                            Adicionar categoria

                        </a>

                    </div>

                </div>

            @else

                <!-- CLIENTE: CATALOGO DE LIVROS -->

                <div class="dashboard-option">

                    <div class="dashboard-icon">

                        <svg width="30"
                             height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.5">

                            <path d="M12 7v14"/>

                            <path d="M3 4h4a5 5 0 0 1 5 5
                                     5 5 0 0 1 5-5h4v15h-4
                                     a5 5 0 0 0-5 2
                                     5 5 0 0 0-5-2H3z"/>

                        </svg>

                    </div>

                    <h3>Catálogo de livros</h3>

                    <p>
                        Descobre os livros disponíveis
                        na nossa loja.
                    </p>

                    <div class="dashboard-buttons">

                        <a href="{{ route('books.index') }}"
                           class="dashboard-button dashboard-secondary">

                            Explorar livros

                        </a>

                    </div>

                </div>

                <!-- CLIENTE: AS MINHAS COMPRAS -->

                <div class="dashboard-option">

                    <div class="dashboard-icon">

                        <svg width="30"
                             height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.5">

                            <path d="M5 7h14l2 14H3L5 7z"/>

                            <path d="M9 9V5a3 3 0 0 1 6 0v4"/>

                        </svg>

                    </div>

                    <h3>As minhas compras</h3>

                    <p>
                        Consulta o histórico das tuas
                        compras na livraria.
                    </p>

                    <div class="dashboard-buttons">

                        <a href="{{ route('sales.index') }}"
                           class="dashboard-button dashboard-secondary">

                            Ver as minhas compras

                        </a>

                    </div>

                </div>

            @endif

        </div>

        <!-- VOLTAR A LOJA -->

        <div class="dashboard-bottom">

            <a href="{{ url('/') }}"
               class="dashboard-button dashboard-primary">

                Voltar à loja

            </a>

        </div>

    </div>

</div>

@endsection
